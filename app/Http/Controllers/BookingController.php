<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use App\Models\ServicePackage;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Hiển thị trang đặt chỗ
    public function index()
    {
        $parkingLots = ParkingLot::where('status', 'active')
            ->where('available_spots', '>', 0)
            ->orderBy('hourly_rate')
            ->get();

        $servicePackages = ServicePackage::where('is_active', true)
            ->orderBy('price')
            ->get();

        $recentBookings = [];
        if (Auth::check()) {
            $recentBookings = Booking::where('user_id', Auth::id())
                ->with(['parkingLot', 'servicePackage'])
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        }

        return view('user.booking', compact('parkingLots', 'servicePackages', 'recentBookings'));
    }


    // Xem chi tiết bãi đỗ xe
    public function showParkingLot($id)
    {
        $parkingLot = ParkingLot::with(['reviews', 'servicePackages'])->findOrFail($id);
        $averageRating = $parkingLot->reviews()->avg('rating') ?? 0;

        return view('user.parking-lot-detail', compact('parkingLot', 'averageRating'));
    }

    // Tạo đặt chỗ mới
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'parking_spot_id' => 'required|exists:parking_spots,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'license_plate' => 'required|string|max:20',
            'phone_number' => 'required|string|max:15',
            'vehicle_type' => 'nullable|string',
            'service_package_id' => 'nullable|exists:service_packages,id',
            'special_requests' => 'nullable|string',
        ]);

        // Lấy thông tin bãi đỗ
        $parkingLot = ParkingLot::findOrFail($validated['parking_lot_id']);

        // Kiểm tra bãi có khả dụng không
        if ($parkingLot->status !== 'active' || $parkingLot->available_spots <= 0) {
            return back()->withErrors(['error' => 'Bãi đỗ xe không khả dụng'])->withInput();
        }

        // Kiểm tra vị trí đỗ có khả dụng không
        $parkingSpot = ParkingSpot::findOrFail($validated['parking_spot_id']);
        if ($parkingSpot->status !== 'available') {
            return back()->withErrors(['error' => 'Vị trí đỗ xe không khả dụng'])->withInput();
        }

        // Kiểm tra vị trí đã được đặt trong khung giờ này chưa
        $conflictBooking = Booking::where('parking_spot_id', $validated['parking_spot_id'])
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhere(function($q) use ($validated) {
                          $q->where('start_time', '<=', $validated['start_time'])
                            ->where('end_time', '>=', $validated['end_time']);
                      });
            })
            ->exists();

        if ($conflictBooking) {
            return back()->withErrors(['error' => 'Vị trí này đã được đặt trong khung giờ bạn chọn'])->withInput();
        }

        // Tính thời gian và giá
        $startTime = Carbon::parse($validated['start_time']);
        $endTime = Carbon::parse($validated['end_time']);
        if ($startTime >= $endTime) {
            return back()->withErrors(['error' => 'Giờ bắt đầu phải nhỏ hơn giờ kết thúc'])->withInput();
        }
        if ($startTime->isSameDay($endTime)) {
            $hours = $endTime->hour - $startTime->hour;
            if ($endTime->minute > $startTime->minute) {
                $hours += 1; // Nếu có phút dư thì tính thêm 1 giờ
            }
        } else {
            $hours = $startTime->diffInHours($endTime);
        }
        $hours = max(1, $hours); // Đảm bảo tối thiểu 1 giờ
        $totalCost = $hours * $parkingLot->hourly_rate;

        // Nếu có gói dịch vụ thì dùng giá gói
        if (!empty($validated['service_package_id'])) {
            $package = ServicePackage::find($validated['service_package_id']);
            if ($package) {
                $totalCost = $package->price;
            }
        }

        // Tạo mã booking
        $bookingCode = 'BK' . now()->format('YmdHis') . strtoupper(substr(md5(rand()), 0, 4));

        // Tạo booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'parking_lot_id' => $validated['parking_lot_id'],
            'parking_spot_id' => $validated['parking_spot_id'],
            'service_package_id' => $validated['service_package_id'] ?? null,
            'booking_code' => $bookingCode,
            'booking_date' => $validated['booking_date'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration_hours' => $hours,
            'vehicle_type' => $validated['vehicle_type'] ?? null,
            'license_plate' => $validated['license_plate'],
            'phone_number' => $validated['phone_number'],
            'special_requests' => $validated['special_requests'] ?? null,
            'total_cost' => $totalCost,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // Tạo payment ngay lập tức
        Payment::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'amount' => $totalCost,
            'payment_method' => 'bank_transfer', // Mặc định
            'payment_status' => 'pending',
            'transaction_id' => 'TXN' . now()->format('YmdHis') . rand(1000, 9999),
        ]);

        return redirect()->route('user.booking.show', $booking->id)
            ->with('success', 'Đặt chỗ thành công! Vui lòng thanh toán để xác nhận.');
    }


    // Xem chi tiết booking
    public function show($id)
    {
        $booking = Booking::with(['parkingLot', 'servicePackage', 'payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.booking-details', compact('booking'));
    }

    // Lịch sử đặt chỗ
    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['parkingLot', 'servicePackage', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.history', compact('bookings'));
    }

    // Hủy đặt chỗ
    public function cancel($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->findOrFail($id);

        if ($booking->status === 'completed') {
            return back()->withErrors(['error' => 'Không thể hủy đặt chỗ đã hoàn thành']);
        }

        $booking->update([
            'status' => 'cancelled',
            'payment_status' => $booking->payment_status === 'completed' ? $booking->payment_status : 'cancelled',
        ]);

        return back()->with('success', 'Đã hủy đặt chỗ thành công');
    }


    // API: Lấy thông tin bãi đỗ
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

    // API: Danh sách bãi đỗ
    public function getParkingLots()
    {
        $parkingLots = ParkingLot::where('status', 'active')
            ->where('available_spots', '>', 0)
            ->orderBy('hourly_rate')
            ->get();

        return response()->json($parkingLots);
    }

    // API: Lấy danh sách vị trí đỗ xe của bãi đỗ
    public function getParkingSpots($parkingLotId, Request $request)
    {
        $parkingLot = ParkingLot::findOrFail($parkingLotId);

        // Lấy thời gian đặt từ request (nếu có)
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        // Lấy tất cả vị trí của bãi đỗ
        $spots = ParkingSpot::where('parking_lot_id', $parkingLotId)
            ->orderBy('level')
            ->orderBy('spot_code')
            ->get();

        // Nếu có thời gian, kiểm tra vị trí nào đã được đặt
        if ($startTime && $endTime) {
            $bookedSpots = Booking::where('parking_lot_id', $parkingLotId)
                ->where('status', '!=', 'cancelled')
                ->where(function($query) use ($startTime, $endTime) {
                    $query->whereBetween('start_time', [$startTime, $endTime])
                          ->orWhereBetween('end_time', [$startTime, $endTime])
                          ->orWhere(function($q) use ($startTime, $endTime) {
                              $q->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                          });
                })
                ->pluck('parking_spot_id')
                ->toArray();

            // Đánh dấu các vị trí đã được đặt
            $spots->each(function($spot) use ($bookedSpots) {
                $spot->is_available = !in_array($spot->id, $bookedSpots) && $spot->status === 'available';
            });
        } else {
            // Nếu không có thời gian, chỉ dựa vào status
            $spots->each(function($spot) {
                $spot->is_available = $spot->status === 'available';
            });
        }

        return response()->json([
            'parking_lot' => [
                'id' => $parkingLot->id,
                'name' => $parkingLot->name,
                'address' => $parkingLot->address,
                'total_spots' => $parkingLot->total_spots,
            ],
            'spots' => $spots
        ]);
    }

    // API: Lịch sử booking của user
    public function getUserBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['parkingLot'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($bookings);
    }

    // API: Chi tiết booking
    public function getBookingDetail($id)
    {
        $booking = Booking::with(['parkingLot', 'payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return response()->json($booking);
    }
}
