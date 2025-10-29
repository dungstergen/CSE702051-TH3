<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\ParkingLot;
use Illuminate\Support\Facades\DB;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of payments
     */
    public function index(Request $request)
    {
        $query = Payment::with(['booking.user', 'booking.parkingLot']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        // Filter by payment method
        if ($request->filled('method')) {
            $query->where('payment_method', $request->input('method'));
        }

        // Filter by payment date (paid_at)
        if ($request->filled('start_date')) {
            $query->whereDate('paid_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('paid_at', '<=', $request->end_date);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('transaction_id', 'like', '%' . $request->search . '%')
                  ->orWhereHas('booking.user', function($userQuery) use ($request) {
                      $userQuery->where('name', 'like', '%' . $request->search . '%')
                              ->orWhere('email', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Display the specified payment
     */
    public function show(Payment $payment)
    {
        $payment->load(['booking.user', 'booking.parkingLot']);
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for creating a new payment
     */
    public function create()
    {
        // Bookings that are not fully paid yet
        $unpaidBookings = Booking::with(['user','parkingLot'])
            ->where(function($q){
                $q->whereNull('payment_status')
                  ->orWhere('payment_status','!=','completed');
            })
            ->orderBy('created_at','desc')
            ->get();

        return view('admin.payments.create', compact('unpaidBookings'));
    }

    /**
     * Store a newly created payment in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:credit_card,bank_transfer,e_wallet,cash',
            'payment_status' => 'required|in:pending,completed,failed',
            'transaction_id' => 'nullable|string',
            'paid_at' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validated) {
            // Lock booking and its lot for consistency
            $booking = Booking::with('parkingLot')->lockForUpdate()->findOrFail($validated['booking_id']);

            // Auto-fill paid_at when completed and not provided
            if ($validated['payment_status'] === 'completed' && empty($validated['paid_at'])) {
                $validated['paid_at'] = now();
            }

            // Create payment
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_status'],
                'transaction_id' => $validated['transaction_id'] ?? null,
                'paid_at' => $validated['paid_at'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            // Sync booking status and payment_status
            $oldStatus = $booking->status;
            $booking->payment_status = $payment->payment_status;
            if ($payment->payment_status === 'completed') {
                $booking->status = 'completed';
            } elseif ($payment->payment_status === 'failed') {
                $booking->status = 'pending';
            }
            $booking->save();

            // Adjust available_spots when moving out of confirmed
            $lot = $booking->parkingLot ? ParkingLot::lockForUpdate()->find($booking->parking_lot_id) : null;
            if ($lot) {
                if ($oldStatus === 'confirmed' && in_array($booking->status, ['cancelled','completed'])) {
                    $lot->update([
                        'available_spots' => min($lot->available_spots + 1, $lot->total_spots)
                    ]);
                }
            }
        });

        return redirect()->route('admin.payments.index')
            ->with('success', 'Tạo thanh toán thành công!');
    }

    /**
     * Show the form for editing the specified payment
     */
    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update the specified payment
     */
    public function update(Request $request, Payment $payment)
    {

        $validated = $request->validate([
            'payment_method' => 'required|in:credit_card,bank_transfer,e_wallet,cash',
            'payment_status' => 'required|in:pending,completed,failed,cancelled',
            'amount' => 'required|numeric|min:0',
            'transaction_id' => 'nullable|string',
            'paid_at' => 'nullable|date'
        ]);


        DB::transaction(function () use ($payment, $validated) {
            $payment->update($validated);

            // Đồng bộ trạng thái booking và điều chỉnh slot nếu cần
            $booking = $payment->booking()->lockForUpdate()->first();
            if ($booking) {
                $oldStatus = $booking->status;

                if ($payment->payment_status === 'completed') {
                    $booking->status = 'completed';
                } elseif ($payment->payment_status === 'cancelled') {
                    $booking->status = 'cancelled';
                } elseif ($payment->payment_status === 'failed') {
                    $booking->status = 'pending';
                }
                $booking->save();

                // Điều chỉnh available_spots theo chuyển trạng thái
                $lot = ParkingLot::lockForUpdate()->find($booking->parking_lot_id);
                if ($lot) {
                    // Nếu chuyển từ confirmed -> cancelled/completed thì trả chỗ
                    if ($oldStatus === 'confirmed' && in_array($booking->status, ['cancelled', 'completed'])) {
                        $lot->update([
                            'available_spots' => min($lot->available_spots + 1, $lot->total_spots)
                        ]);
                    }
                    // Nếu chuyển sang confirmed (ít xảy ra trong form này) thì trừ chỗ
                    if ($booking->status === 'confirmed' && $oldStatus !== 'confirmed') {
                        if ($lot->available_spots > 0) {
                            $lot->decrement('available_spots');
                        }
                    }
                }
            }
        });

        return redirect()->route('admin.payments.index')
                        ->with('success', 'Cập nhật thanh toán thành công!');
    }

    /**
     * Remove the specified payment
     */
    public function destroy(Payment $payment)
    {
        // Only allow deletion of failed payments
        if ($payment->payment_status !== 'failed') {
            return redirect()->route('admin.payments.index')
                            ->with('error', 'Chỉ có thể xóa thanh toán thất bại!');
        }

        $payment->delete();

        return redirect()->route('admin.payments.index')
                        ->with('success', 'Xóa thanh toán thành công!');
    }

    /**
     * Update payment status
     */
    public function updateStatus(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,completed,failed,refunded'
        ]);

        DB::transaction(function () use ($payment, $validated) {
            // Set paid_at automatically when marking completed
            $attrs = ['payment_status' => $validated['payment_status']];
            if ($validated['payment_status'] === 'completed' && !$payment->paid_at) {
                $attrs['paid_at'] = now();
            }
            if ($validated['payment_status'] === 'refunded') {
                $attrs['refunded_at'] = now();
            }
            $payment->update($attrs);

            // Sync booking status and payment_status
            $booking = $payment->booking()->with('parkingLot')->lockForUpdate()->first();
            if ($booking) {
                $oldStatus = $booking->status;
                $booking->payment_status = $payment->payment_status;

                if ($payment->payment_status === 'completed') {
                    $booking->status = 'completed';
                } elseif ($payment->payment_status === 'refunded') {
                    $booking->status = 'cancelled';
                } elseif ($payment->payment_status === 'failed') {
                    $booking->status = 'pending';
                } elseif ($payment->payment_status === 'pending') {
                    // keep existing booking status if sensible
                    $booking->status = in_array($oldStatus, ['pending','confirmed']) ? $oldStatus : 'pending';
                }
                $booking->save();

                // Adjust lot availability when moving off confirmed to cancelled/completed
                $lot = $booking->parkingLot ? ParkingLot::lockForUpdate()->find($booking->parking_lot_id) : null;
                if ($lot) {
                    if ($oldStatus === 'confirmed' && in_array($booking->status, ['cancelled','completed'])) {
                        $lot->update([
                            'available_spots' => min($lot->available_spots + 1, $lot->total_spots)
                        ]);
                    }
                    if ($booking->status === 'confirmed' && $oldStatus !== 'confirmed') {
                        if ($lot->available_spots > 0) {
                            $lot->decrement('available_spots');
                        }
                    }
                }
            }
        });

        return redirect()->route('admin.payments.index')
            ->with('success', 'Cập nhật trạng thái thanh toán thành công!');
    }

    /**
     * Process refund
     */
    public function refund(Payment $payment)
    {
        if ($payment->payment_status !== 'completed') {
            return redirect()->route('admin.payments.index')
                            ->with('error', 'Chỉ có thể hoàn tiền cho thanh toán đã hoàn thành!');
        }

        // Process refund logic here
        $payment->update([
            'payment_status' => 'refunded',
            'refunded_at' => now(),
            'notes' => 'Refunded by admin'
        ]);

        return redirect()->route('admin.payments.index')
                        ->with('success', 'Hoàn tiền thành công!');
    }
}
