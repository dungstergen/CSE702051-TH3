<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ParkingLot;
use App\Models\User;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'parkingLot']);

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
        $parkingLots = ParkingLot::where('is_active', true)->get();

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
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'vehicle_type' => 'nullable|string|max:50',
            'vehicle_number' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // Calculate duration and total amount
        $startTime = strtotime($validated['start_time']);
        $endTime = strtotime($validated['end_time']);
        $durationHours = ceil(($endTime - $startTime) / 3600);

        $parkingLot = ParkingLot::find($validated['parking_lot_id']);
        $totalAmount = $durationHours * $parkingLot->hourly_rate;

        $validated['duration_hours'] = $durationHours;
        $validated['total_amount'] = $totalAmount;
        $validated['start_time'] = $validated['booking_date'] . ' ' . $validated['start_time'];
        $validated['end_time'] = $validated['booking_date'] . ' ' . $validated['end_time'];

        Booking::create($validated);

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
        $parkingLots = ParkingLot::where('is_active', true)->get();

        return view('admin.bookings.edit', compact('booking', 'users', 'parkingLots'));
    }

    /**
     * Update the specified booking
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'vehicle_type' => 'nullable|string|max:50',
            'vehicle_number' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // Calculate duration and total amount
        $startTime = strtotime($validated['start_time']);
        $endTime = strtotime($validated['end_time']);
        $durationHours = ceil(($endTime - $startTime) / 3600);

        $parkingLot = ParkingLot::find($validated['parking_lot_id']);
        $totalAmount = $durationHours * $parkingLot->hourly_rate;

        $validated['duration_hours'] = $durationHours;
        $validated['total_amount'] = $totalAmount;
        $validated['start_time'] = $validated['booking_date'] . ' ' . $validated['start_time'];
        $validated['end_time'] = $validated['booking_date'] . ' ' . $validated['end_time'];

        $booking->update($validated);

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
