<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ParkingLot;
use App\Models\ServicePackage;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function __construct(
        private BookingService $bookingService
    ) {}

    /**
     * Display the booking page with available parking lots
     */
    public function index()
    {
        // Get available parking lots
        $parkingLots = ParkingLot::where('status', 'active')
            ->where('available_spots', '>', 0)
            ->orderBy('hourly_rate')
            ->get();

        // Get service packages
        $servicePackages = ServicePackage::where('is_active', true)
            ->orderBy('price')
            ->get();

        // Get user's recent bookings for quick rebooking (only if logged in)
        $recentBookings = collect([]);
        if (Auth::check()) {
            $recentBookings = Booking::where('user_id', Auth::id())
                ->with(['parkingLot', 'servicePackage'])
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        }

        return view('user.booking', compact('parkingLots', 'servicePackages', 'recentBookings'));
    }

    /**
     * Show a parking lot detail page
     */
    public function showParkingLot($id)
    {
        $parkingLot = ParkingLot::with(['reviews' => function($q){
            $q->visible()->orderBy('created_at', 'desc')->limit(10);
        }, 'servicePackages'])->findOrFail($id);

        $averageRating = method_exists($parkingLot, 'getAverageRatingAttribute')
            ? $parkingLot->average_rating
            : ($parkingLot->reviews()->visible()->avg('rating') ?? 0);

        return view('user.parking-lot-detail', compact('parkingLot', 'averageRating'));
    }

    /**
     * Store a new booking
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            $booking = $this->bookingService->createBooking(
                $request->validated(),
                Auth::user()
            );

            return redirect()
                ->route('user.booking.show', $booking->id)
                ->with('success', 'Đặt chỗ thành công! Vui lòng thanh toán để xác nhận.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
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
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['parkingLot', 'servicePackage', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.history', compact('bookings'));
    }

    /**
     * Cancel a booking
     */
    public function cancel($id)
    {
        try {
            $booking = Booking::where('user_id', Auth::id())
                ->where('status', '!=', 'completed')
                ->findOrFail($id);

            $this->bookingService->cancelBooking($booking);

            return back()->with('success', 'Đã hủy đặt chỗ thành công');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
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

    /**
     * Get all parking lots for API (AJAX)
     */
    public function getParkingLots()
    {
        $parkingLots = ParkingLot::where('status', 'active')
            ->where('available_spots', '>', 0)
            ->orderBy('hourly_rate')
            ->get()
            ->map(function($lot) {
                return [
                    'id' => $lot->id,
                    'name' => $lot->name,
                    'address' => $lot->address,
                    'available_spaces' => $lot->available_spots,
                    'total_spaces' => $lot->total_spots,
                    'hourly_rate' => $lot->hourly_rate,
                    'rating' => 4.5, // TODO: Calculate from reviews
                    'image' => asset('user/images/parking1.jpg') // Default image
                ];
            });

        return response()->json($parkingLots);
    }

    /**
     * Get user bookings for API (AJAX)
     */
    public function getUserBookings()
    {
        $user = Auth::user();

        $bookings = Booking::where('user_id', $user->id)
            ->with(['parkingLot'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($booking) {
                return [
                    'id' => $booking->booking_code ?? 'BK' . $booking->id,
                    'parking_lot' => $booking->parkingLot->name,
                    'address' => $booking->parkingLot->address,
                    'start_time' => $booking->start_time->format('Y-m-d H:i'),
                    'end_time' => $booking->end_time->format('Y-m-d H:i'),
                    'vehicle_number' => $booking->license_plate,
                    'vehicle_type' => $booking->vehicle_type,
                    'total_fee' => $booking->total_cost,
                    'status' => $booking->status,
                    'payment_status' => $booking->payment_status
                ];
            });

        return response()->json($bookings);
    }

    /**
     * Get booking detail for API (AJAX)
     */
    public function getBookingDetail($id)
    {
        $booking = Booking::with(['parkingLot', 'payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return response()->json([
            'id' => $booking->booking_code ?? 'BK' . $booking->id,
            'parking_lot' => $booking->parkingLot->name,
            'address' => $booking->parkingLot->address,
            'start_time' => $booking->start_time->format('Y-m-d H:i'),
            'end_time' => $booking->end_time->format('Y-m-d H:i'),
            'duration_hours' => $booking->duration_hours,
            'vehicle_type' => $booking->vehicle_type,
            'license_plate' => $booking->license_plate,
            'total_cost' => $booking->total_cost,
            'status' => $booking->status,
            'payment_status' => $booking->payment_status,
            'payment' => $booking->payment
        ]);
    }
}
