<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display payment page for a booking
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $bookingId = $request->query('booking_id');

        if (!$bookingId) {
            return redirect()->route('user.booking')->withErrors(['error' => 'Không tìm thấy thông tin đặt chỗ']);
        }

        $booking = Booking::with(['parkingLot', 'servicePackage', 'payment'])
            ->where('user_id', $user->id)
            ->where('id', $bookingId)
            ->first();

        if (!$booking) {
            return redirect()->route('user.booking')->withErrors(['error' => 'Không tìm thấy thông tin đặt chỗ']);
        }

        if ($booking->payment_status === 'completed') {
            return redirect()->route('user.booking.show', $booking->id)
                ->with('info', 'Đặt chỗ này đã được thanh toán');
        }

        // Available payment methods
        $paymentMethods = [
            'momo' => [
                'name' => 'Ví MoMo',
                'icon' => 'fa-mobile',
                'description' => 'Thanh toán qua ví điện tử MoMo',
                'fee' => 0
            ],
            'zalopay' => [
                'name' => 'ZaloPay',
                'icon' => 'fa-credit-card',
                'description' => 'Thanh toán qua ví ZaloPay',
                'fee' => 0
            ],
            'bank_transfer' => [
                'name' => 'Chuyển khoản ngân hàng',
                'icon' => 'fa-bank',
                'description' => 'Chuyển khoản qua ATM/Internet Banking',
                'fee' => 0
            ],
            'cash' => [
                'name' => 'Tiền mặt',
                'icon' => 'fa-money',
                'description' => 'Thanh toán tiền mặt tại chỗ',
                'fee' => 0
            ]
        ];

        return view('user.payment', compact('booking', 'paymentMethods'));
    }

    /**
     * Process payment
     */
    public function process(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:momo,zalopay,bank_transfer,cash',
            'phone_number' => 'required_if:payment_method,momo,zalopay|string|max:15'
        ], [
            'booking_id.required' => 'Không tìm thấy thông tin đặt chỗ',
            'booking_id.exists' => 'Thông tin đặt chỗ không hợp lệ',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán',
            'payment_method.in' => 'Phương thức thanh toán không hợp lệ',
            'phone_number.required_if' => 'Vui lòng nhập số điện thoại cho thanh toán điện tử'
        ]);

        $user = Auth::user();
        $booking = Booking::with('payment')
            ->where('user_id', $user->id)
            ->findOrFail($request->booking_id);

        if ($booking->payment_status === 'completed') {
            return back()->withErrors(['error' => 'Đặt chỗ này đã được thanh toán']);
        }

        // Generate transaction ID
        $transactionId = 'TXN' . date('YmdHis') . strtoupper(Str::random(4));

        // Normalize method to match DB enum
        $normalizedMethod = match ($request->payment_method) {
            'momo', 'zalopay' => 'e_wallet',
            'bank_transfer' => 'bank_transfer',
            'cash' => 'cash',
            default => 'bank_transfer',
        };

        // Update or create payment record
        $payment = $booking->payment;
        if (!$payment) {
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'user_id' => $user->id,
                'amount' => $booking->total_cost,
                'payment_method' => $normalizedMethod,
                'payment_status' => 'pending',
                'transaction_id' => $transactionId,
                'gateway_response' => [
                    'phone_number' => $request->phone_number,
                    'init_time' => now()->toDateTimeString(),
                    'ip_address' => $request->ip(),
                ]
            ]);
        } else {
            $payment->update([
                'payment_method' => $normalizedMethod,
                'transaction_id' => $transactionId,
                'gateway_response' => [
                    'phone_number' => $request->phone_number,
                    'init_time' => now()->toDateTimeString(),
                    'ip_address' => $request->ip(),
                ]
            ]);
        }

        // Simulate payment processing based on method
        switch ($request->payment_method) {
            case 'momo':
            case 'zalopay':
                return $this->processEWalletPayment($booking, $payment, $request->payment_method);

            case 'bank_transfer':
                return $this->processBankTransfer($booking, $payment);

            case 'cash':
                return $this->processCashPayment($booking, $payment);

            default:
                return back()->withErrors(['error' => 'Phương thức thanh toán không được hỗ trợ']);
        }
    }

    /**
     * Process e-wallet payment (MoMo/ZaloPay)
     */
    private function processEWalletPayment($booking, $payment, $method)
    {
        // In a real application, you would integrate with MoMo/ZaloPay APIs
        // For demo purposes, we'll simulate immediate success

        $payment->update([
            'payment_status' => 'completed',
            'paid_at' => now()
        ]);

        $booking->update([
            'payment_status' => 'completed',
            'status' => 'confirmed'
        ]);

        return redirect()->route('user.payment.success', ['payment' => $payment->id])
            ->with('success', 'Thanh toán thành công qua ' . ($method === 'momo' ? 'MoMo' : 'ZaloPay'));
    }

    /**
     * Process bank transfer
     */
    private function processBankTransfer($booking, $payment)
    {
        // Bank transfer requires manual verification; keep status pending
        $payment->update([
            'payment_status' => 'pending'
        ]);

        return redirect()->route('user.payment.pending', ['payment' => $payment->id])
            ->with('info', 'Vui lòng thực hiện chuyển khoản và chờ xác nhận từ hệ thống');
    }

    /**
     * Process cash payment
     */
    private function processCashPayment($booking, $payment)
    {
        // Cash payment will be collected on-site; keep status pending
        $payment->update([
            'payment_status' => 'pending'
        ]);

        $booking->update([
            'status' => 'confirmed'
        ]);

        return redirect()->route('user.payment.cash', ['payment' => $payment->id])
            ->with('success', 'Đặt chỗ đã được xác nhận. Vui lòng thanh toán tiền mặt khi đến bãi xe');
    }

    /**
     * Payment success page
     */
    public function success($paymentId)
    {
        $payment = Payment::with(['booking.parkingLot', 'booking.servicePackage'])
            ->where('user_id', Auth::id())
            ->findOrFail($paymentId);

        return view('user.payment-success', compact('payment'));
    }

    /**
     * Payment pending page
     */
    public function pending($paymentId)
    {
        $payment = Payment::with(['booking.parkingLot'])
            ->where('user_id', Auth::id())
            ->findOrFail($paymentId);

        return view('user.payment-pending', compact('payment'));
    }

    /**
     * Cash payment confirmation page
     */
    public function cash($paymentId)
    {
        $payment = Payment::with(['booking.parkingLot', 'booking.servicePackage'])
            ->where('user_id', Auth::id())
            ->findOrFail($paymentId);

        return view('user.payment-cash', compact('payment'));
    }

    /**
     * Payment history
     */
    public function history()
    {
        $user = Auth::user();

        $payments = Payment::with(['booking.parkingLot', 'booking.servicePackage'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.payment-history', compact('payments'));
    }

    /**
     * Cancel payment
     */
    public function cancel($paymentId)
    {
        $payment = Payment::where('user_id', Auth::id())
            ->where('payment_status', '!=', 'completed')
            ->findOrFail($paymentId);

        $payment->update(['payment_status' => 'cancelled']);
        $payment->booking->update(['payment_status' => 'cancelled']);

        return redirect()->route('user.history')
            ->with('success', 'Đã hủy thanh toán thành công');
    }
}
