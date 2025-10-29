<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ParkingLot;
use App\Models\User;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index(Request $request)
    {
    $query = Booking::with(['user', 'parkingLot', 'payment']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('booking_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('booking_date', '<=', $request->end_date);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            })->orWhereHas('parkingLot', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get parking lots for filter dropdown
        $parkingLots = ParkingLot::all();

        return view('admin.bookings.index', compact('bookings', 'parkingLots'));
    }

    /**
     * Show the form for creating a new booking
     */
    public function create()
    {
        $users = User::where('is_active', true)->get();
        // ParkingLot doesn't have is_active column; use status='active' instead
        $parkingLots = ParkingLot::where('status', 'active')->get();

        return view('admin.bookings.create', compact('users', 'parkingLots'));
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'vehicle_type' => 'nullable|string|max:50',
            'license_plate' => 'required|string|max:20',
            'phone_number' => 'required|string|max:20',
            'special_requests' => 'nullable|string',
            // status enum matches DB: pending, confirmed, cancelled, completed
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // Parse times and derive booking_date
        $startTime = Carbon::parse($validated['start_time']);
        $endTime = Carbon::parse($validated['end_time']);

        // Calculate duration hours (ceil, min 1)
        $diffHours = $startTime->diffInMinutes($endTime, false) / 60;
        $durationHours = max(1, (int) ceil($diffHours));

        // Calculate total cost
        $parkingLot = ParkingLot::findOrFail($validated['parking_lot_id']);
        $totalCost = $durationHours * (float) $parkingLot->hourly_rate;

        // Generate booking code
        $bookingCode = 'BK' . now()->format('YmdHis') . strtoupper(substr(md5(uniqid('', true)), 0, 4));

        Booking::create([
            'user_id' => $validated['user_id'],
            'parking_lot_id' => $validated['parking_lot_id'],
            'booking_code' => $bookingCode,
            'booking_date' => $startTime->toDateString(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration_hours' => $durationHours,
            'vehicle_type' => $validated['vehicle_type'] ?? null,
            'license_plate' => $validated['license_plate'],
            'phone_number' => $validated['phone_number'],
            'special_requests' => $validated['special_requests'] ?? null,
            'total_cost' => $totalCost,
            'status' => $validated['status'],
            // payment_status will use DB default 'pending'
        ]);

        return redirect()->route('admin.bookings.index')
                        ->with('success', 'Tạo đặt chỗ thành công!');
    }

    /**
     * Display the specified booking
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'parkingLot', 'payment']);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking
     */
    public function edit(Booking $booking)
    {
        $users = User::where('is_active', true)->get();
        $parkingLots = ParkingLot::where('status', 'active')->get();

        return view('admin.bookings.edit', compact('booking', 'users', 'parkingLots'));
    }

    /**
     * Update the specified booking
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'parking_lot_id' => 'sometimes|exists:parking_lots,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'vehicle_type' => 'nullable|string|max:50',
            'license_plate' => 'required|string|max:20',
            'phone_number' => 'sometimes|string|max:20',
            'special_requests' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // Parse times and derive booking_date
        $startTime = Carbon::parse($validated['start_time']);
        $endTime = Carbon::parse($validated['end_time']);

        // Calculate duration hours (ceil, min 1)
        $diffHours = $startTime->diffInMinutes($endTime, false) / 60;
        $durationHours = max(1, (int) ceil($diffHours));

        // Calculate total cost
    $parkingLot = ParkingLot::findOrFail($validated['parking_lot_id'] ?? $booking->parking_lot_id);
        $totalCost = $durationHours * (float) $parkingLot->hourly_rate;

        $booking->update([
            'user_id' => $validated['user_id'] ?? $booking->user_id,
            'parking_lot_id' => $validated['parking_lot_id'] ?? $booking->parking_lot_id,
            'booking_date' => $startTime->toDateString(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration_hours' => $durationHours,
            'vehicle_type' => $validated['vehicle_type'] ?? null,
            'license_plate' => $validated['license_plate'],
            'phone_number' => $validated['phone_number'] ?? $booking->phone_number,
            'special_requests' => $validated['special_requests'] ?? null,
            'total_cost' => $totalCost,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.bookings.index')
                        ->with('success', 'Cập nhật đặt chỗ thành công!');
    }

    /**
     * Remove the specified booking
     */
    public function destroy(Booking $booking)
    {
        // Only allow deletion of cancelled bookings
        if (!in_array($booking->status, ['cancelled', 'completed'])) {
            return redirect()->route('admin.bookings.index')
                            ->with('error', 'Chỉ có thể xóa đặt chỗ đã hủy hoặc hoàn thành!');
        }

        $booking->delete();

        return redirect()->route('admin.bookings.index')
                        ->with('success', 'Xóa đặt chỗ thành công!');
    }

    /**
     * Update booking status
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')
                        ->with('success', 'Cập nhật trạng thái đặt chỗ thành công!');
    }
}
