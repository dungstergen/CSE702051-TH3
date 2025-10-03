<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ParkingLot;
use App\Models\ServicePackage;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Constructor will be handled by routes middleware

    /**
     * Display the booking page with available parking lots
     */
    public function index()
    {
        $user = Auth::user();

        // Get available parking lots
        $parkingLots = ParkingLot::where('status', 'active')
            ->where('available_spots', '>', 0)
            ->orderBy('hourly_rate')
            ->get();

        // Get service packages
        $servicePackages = ServicePackage::where('is_active', true)
            ->orderBy('price')
            ->get();

        // Get user's recent bookings for quick rebooking
        $recentBookings = Booking::where('user_id', $user->id)
            ->with(['parkingLot', 'servicePackage'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('user.booking', compact('parkingLots', 'servicePackages', 'recentBookings'));
    }

    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'service_package_id' => 'nullable|exists:service_packages,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'vehicle_type' => 'required|in:car,motorcycle,bicycle',
            'license_plate' => 'required|string|max:20',
            'phone_number' => 'required|string|max:15',
            'special_requests' => 'nullable|string|max:500'
        ], [
            'parking_lot_id.required' => 'Vui lòng chọn bãi đỗ xe',
            'parking_lot_id.exists' => 'Bãi đỗ xe không tồn tại',
            'service_package_id.exists' => 'Gói dịch vụ không tồn tại',
            'start_time.required' => 'Vui lòng chọn thời gian bắt đầu',
            'start_time.after' => 'Thời gian bắt đầu phải sau thời điểm hiện tại',
            'end_time.required' => 'Vui lòng chọn thời gian kết thúc',
            'end_time.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu',
            'vehicle_type.required' => 'Vui lòng chọn loại xe',
            'vehicle_type.in' => 'Loại xe không hợp lệ',
            'license_plate.required' => 'Vui lòng nhập biển số xe',
            'phone_number.required' => 'Vui lòng nhập số điện thoại'
        ]);

        $user = Auth::user();
        $parkingLot = ParkingLot::findOrFail($request->parking_lot_id);

        // Check availability
        if ($parkingLot->available_spots <= 0) {
            return back()->withErrors(['parking_lot_id' => 'Bãi đỗ xe đã hết chỗ trống']);
        }

        // Calculate duration and total cost
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        $durationHours = $startTime->diffInHours($endTime);

        $totalCost = $durationHours * $parkingLot->hourly_rate;

        // Add service package cost if selected
        $servicePackage = null;
        if ($request->service_package_id) {
            $servicePackage = ServicePackage::findOrFail($request->service_package_id);
            $totalCost += $servicePackage->price;
        }

        // Create booking
        $booking = Booking::create([
            'user_id' => $user->id,
            'parking_lot_id' => $request->parking_lot_id,
            'service_package_id' => $request->service_package_id,
            'booking_code' => 'BK' . date('Ymd') . str_pad(Booking::count() + 1, 4, '0', STR_PAD_LEFT),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration_hours' => $durationHours,
            'vehicle_type' => $request->vehicle_type,
            'license_plate' => strtoupper($request->license_plate),
            'phone_number' => $request->phone_number,
            'special_requests' => $request->special_requests,
            'total_cost' => $totalCost,
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        // Update parking lot availability
        $parkingLot->decrement('available_spots');

        // Create payment record
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'user_id' => $user->id,
            'amount' => $totalCost,
            'payment_method' => 'pending',
            'payment_status' => 'pending',
            'transaction_id' => null
        ]);

        return redirect()->route('booking.show', $booking->id)
            ->with('success', 'Đặt chỗ thành công! Vui lòng thanh toán để xác nhận.');
    }

    /**
     * Show booking details
     */
    public function show($id)
    {
        $booking = Booking::with(['parkingLot', 'servicePackage', 'payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.booking-details', compact('booking'));
    }

    /**
     * Show booking history
     */
    public function history()
    {
        $user = Auth::user();

        $bookings = Booking::where('user_id', $user->id)
            ->with(['parkingLot', 'servicePackage', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.booking-history', compact('bookings'));
    }

    /**
     * Cancel a booking
     */
    public function cancel($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->findOrFail($id);

        // Check if booking can be cancelled (at least 1 hour before start time)
        if (Carbon::now()->addHour()->gt($booking->start_time)) {
            return back()->withErrors(['error' => 'Không thể hủy đặt chỗ trong vòng 1 giờ trước thời gian bắt đầu']);
        }

        // Update booking status
        $booking->update(['status' => 'cancelled']);

        // Update payment status if not completed
        if ($booking->payment && $booking->payment->payment_status !== 'completed') {
            $booking->payment->update(['payment_status' => 'cancelled']);
        }

        // Restore parking lot availability
        $booking->parkingLot->increment('available_spots');

        return back()->with('success', 'Đã hủy đặt chỗ thành công');
    }

    /**
     * Get parking lot details for AJAX
     */
    public function getParkingLotDetails($id)
    {
        $parkingLot = ParkingLot::with('servicePackages')->findOrFail($id);

        return response()->json([
            'id' => $parkingLot->id,
            'name' => $parkingLot->name,
            'address' => $parkingLot->address,
            'hourly_rate' => $parkingLot->hourly_rate,
            'available_spots' => $parkingLot->available_spots,
            'total_spots' => $parkingLot->total_spots,
            'facilities' => $parkingLot->facilities ?? [],
            'service_packages' => $parkingLot->servicePackages
        ]);
    }
}
