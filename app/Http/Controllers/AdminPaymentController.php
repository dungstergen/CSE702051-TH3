<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

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

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
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
            'payment_method' => 'nullable|in:momo,zalopay,vnpay,banking,cash',
            'payment_status' => 'required|in:pending,completed,failed,refunded',
            'notes' => 'nullable|string'
        ]);

        $payment->update($validated);

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

        $payment->update($validated);

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
