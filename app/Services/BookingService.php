<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\ParkingLot;
use App\Models\ServicePackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * Create a booking from validated data
     *
     * @param array $data Validated booking data
     * @param User $user The authenticated user
     * @return Booking
     */
    public function createBooking(array $data, User $user): Booking
    {
        $parkingLot = ParkingLot::findOrFail($data['parking_lot_id']);

        // Basic availability check (lot must be active)
        if (method_exists($parkingLot, 'isAvailable')) {
            if (!$parkingLot->isAvailable()) {
                throw new \RuntimeException('Bãi đỗ xe hiện không khả dụng.');
            }
        }

        // Parse times
        $start = Carbon::parse($data['start_time']);
        $end = Carbon::parse($data['end_time']);

        if ($end->lessThanOrEqualTo($start)) {
            throw new \InvalidArgumentException('Thời gian kết thúc phải sau thời gian bắt đầu.');
        }

        // Calculate duration in hours (ceil to next hour)
        $durationHours = (int) ceil($end->floatDiffInHours($start));

        // Calculate total cost based on hourly rate (simple rule)
        $totalCost = $durationHours * (float) $parkingLot->hourly_rate;

        // If a service package is selected and has a price, prefer that price
        if (!empty($data['service_package_id'])) {
            $package = ServicePackage::find($data['service_package_id']);
            if ($package && isset($package->price)) {
                // Use package price as base; could be extended to combine
                $totalCost = (float) $package->price;
            }
        }

        // Generate a booking code
        $bookingCode = 'BK' . now()->format('YmdHis') . strtoupper(Str::random(4));

        // Create the booking
        return Booking::create([
            'user_id' => $user->id,
            'parking_lot_id' => $data['parking_lot_id'],
            'service_package_id' => $data['service_package_id'] ?? null,
            'booking_code' => $bookingCode,
            'booking_date' => Carbon::parse($data['booking_date'])->toDateString(),
            'start_time' => $start,
            'end_time' => $end,
            'duration_hours' => $durationHours,
            'vehicle_type' => $data['vehicle_type'] ?? null,
            'license_plate' => $data['license_plate'],
            'phone_number' => $data['phone_number'],
            'special_requests' => $data['special_requests'] ?? null,
            'total_cost' => $totalCost,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);
    }

    /**
     * Cancel a booking and update related fields
     */
    public function cancelBooking(Booking $booking): void
    {
        if ($booking->status === 'completed') {
            throw new \RuntimeException('Không thể hủy đặt chỗ đã hoàn thành.');
        }

        $booking->update([
            'status' => 'cancelled',
            'payment_status' => $booking->payment_status === 'completed' ? $booking->payment_status : 'cancelled',
        ]);
    }
}
