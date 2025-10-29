<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\ParkingLot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    // Trang thanh toán
    public function show(Request $request)
    {
        $bookingId = $request->query('booking_id');
        if (!$bookingId) {
            return redirect()->route('user.booking')->withErrors(['error' => 'Không tìm thấy thông tin đặt chỗ']);
        }

        $booking = Booking::with(['parkingLot', 'servicePackage', 'payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($bookingId);

        if ($booking->payment_status === 'completed') {
            return redirect()->route('user.booking.show', $booking->id)
                ->with('info', 'Đặt chỗ này đã được thanh toán');
        }

        $paymentMethods = [
            'momo' => ['name' => 'Ví MoMo', 'icon' => 'fa-mobile'],
            'zalopay' => ['name' => 'ZaloPay', 'icon' => 'fa-credit-card'],
            'bank_transfer' => ['name' => 'Chuyển khoản', 'icon' => 'fa-bank'],
            'cash' => ['name' => 'Tiền mặt', 'icon' => 'fa-money']
        ];

        return view('user.payment', compact('booking', 'paymentMethods'));
    }

    // Xử lý thanh toán
    public function process(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:momo,zalopay,bank_transfer,cash',
            'phone_number' => 'nullable|string|max:15'
        ]);

        $booking = Booking::where('user_id', Auth::id())->findOrFail($request->booking_id);

        if ($booking->payment_status === 'completed') {
            return back()->withErrors(['error' => 'Đặt chỗ này đã được thanh toán']);
        }

        // Tạo mã giao dịch
        $transactionId = 'TXN' . date('YmdHis') . rand(1000, 9999);

        // Chuyển đổi method
        $method = match ($request->payment_method) {
            'momo', 'zalopay' => 'e_wallet',
            'bank_transfer' => 'bank_transfer',
            'cash' => 'cash',
            default => 'bank_transfer',
        };

        // Tạo hoặc cập nhật payment
        $payment = Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'user_id' => Auth::id(),
                'amount' => $booking->total_cost,
                'payment_method' => $method,
                'payment_status' => 'pending',
                'transaction_id' => $transactionId,
            ]
        );

        // Xử lý theo phương thức
        if (in_array($request->payment_method, ['momo', 'zalopay'])) {
            // Giả lập thanh toán ví điện tử thành công
            DB::transaction(function () use ($payment, $booking) {
                // Cập nhật trạng thái thanh toán
                $payment->update(['payment_status' => 'completed', 'paid_at' => now()]);

                // Chỉ điều chỉnh slot khi chuyển sang confirmed lần đầu
                if ($booking->status !== 'confirmed') {
                    // Khóa hàng bãi đỗ để cập nhật an toàn
                    $lot = ParkingLot::lockForUpdate()->find($booking->parking_lot_id);
                    if ($lot) {
                        // Giảm available_spots nhưng không âm
                        if ($lot->available_spots > 0) {
                            $lot->decrement('available_spots');
                        }
                    }
                }

                // Cập nhật trạng thái booking
                $booking->update(['payment_status' => 'completed', 'status' => 'confirmed']);
            });

            return redirect()->route('user.payment.success', $payment->id)
                ->with('success', 'Thanh toán thành công!');
        }

        if ($request->payment_method === 'cash') {
            DB::transaction(function () use ($booking) {
                if ($booking->status !== 'confirmed') {
                    $lot = ParkingLot::lockForUpdate()->find($booking->parking_lot_id);
                    if ($lot) {
                        if ($lot->available_spots > 0) {
                            $lot->decrement('available_spots');
                        }
                    }
                }
                $booking->update(['status' => 'confirmed']);
            });

            return redirect()->route('user.payment.cash', $payment->id)
                ->with('success', 'Đặt chỗ đã xác nhận. Thanh toán tiền mặt khi đến.');
        }

        // Bank transfer
        return redirect()->route('user.payment.pending', $payment->id)
            ->with('info', 'Vui lòng chuyển khoản và chờ xác nhận');
    }


    // Trang thanh toán thành công
    public function success($paymentId)
    {
        $payment = Payment::with(['booking.parkingLot'])
            ->where('user_id', Auth::id())
            ->findOrFail($paymentId);

        return view('user.payment-success', compact('payment'));
    }

    // Trang chờ xác nhận
    public function pending($paymentId)
    {
        $payment = Payment::with(['booking.parkingLot'])
            ->where('user_id', Auth::id())
            ->findOrFail($paymentId);

        return view('user.payment-pending', compact('payment'));
    }

    // Trang thanh toán tiền mặt
    public function cash($paymentId)
    {
        $payment = Payment::with(['booking.parkingLot'])
            ->where('user_id', Auth::id())
            ->findOrFail($paymentId);

        return view('user.payment-cash', compact('payment'));
    }

    // Lịch sử thanh toán
    public function history()
    {
        $payments = Payment::with(['booking.parkingLot'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.payment-history', compact('payments'));
    }

    // Hủy thanh toán
    public function cancel($paymentId)
    {
        $payment = Payment::where('user_id', Auth::id())
            ->where('payment_status', '!=', 'completed')
            ->findOrFail($paymentId);

        $payment->update(['payment_status' => 'cancelled']);
        $payment->booking->update(['payment_status' => 'cancelled']);

        return redirect()->route('user.history')->with('success', 'Đã hủy thanh toán');
    }
}
