<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\ParkingLot;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $parkingLots = ParkingLot::all();

        if ($users->isEmpty() || $parkingLots->isEmpty()) {
            $this->command->error('Please seed Users and ParkingLots first!');
            return;
        }

        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        $vehicleTypes = ['car', 'motorcycle', 'bicycle'];

        $bookings = [];

        // Tạo 20 bookings mẫu
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $parkingLot = $parkingLots->random();

            // Random thời gian trong 30 ngày qua và 7 ngày tới
            $daysOffset = rand(-30, 7);
            $startTime = Carbon::now()->addDays($daysOffset)->setHour(rand(8, 18))->setMinute(0);
            $durationHours = rand(2, 8);
            $endTime = $startTime->copy()->addHours($durationHours);

            // Xác định status dựa trên thời gian
            if ($daysOffset < -7) {
                $status = 'completed';
            } elseif ($daysOffset < 0) {
                $status = rand(0, 1) ? 'completed' : 'cancelled';
            } elseif ($daysOffset == 0) {
                $status = 'confirmed';
            } else {
                $status = rand(0, 1) ? 'confirmed' : 'pending';
            }

            $totalCost = $durationHours * $parkingLot->hourly_rate;

            $bookings[] = [
                'user_id' => $user->id,
                'parking_lot_id' => $parkingLot->id,
                'booking_code' => 'BK' . date('Ymd') . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'duration_hours' => $durationHours,
                'vehicle_type' => $vehicleTypes[array_rand($vehicleTypes)],
                'license_plate' => $this->generateLicensePlate(),
                'phone_number' => $user->phone,
                'special_requests' => rand(0, 1) ? 'Cần chỗ đỗ gần lối ra' : null,
                'total_cost' => $totalCost,
                'status' => $status,
                'payment_status' => $status === 'completed' ? 'completed' : ($status === 'cancelled' ? 'cancelled' : 'pending'),
                'created_at' => $startTime->copy()->subDays(rand(1, 3)),
                'updated_at' => now(),
            ];
        }

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }

        $this->command->info('Bookings seeded successfully!');
        $this->command->info('Created ' . count($bookings) . ' bookings with various statuses.');
    }

    /**
     * Generate random Vietnamese license plate
     */
    private function generateLicensePlate(): string
    {
        $provinces = ['29', '30', '31', '50', '51', '59', '60', '61'];
        $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'K', 'L', 'M'];

        $province = $provinces[array_rand($provinces)];
        $letter = $letters[array_rand($letters)];
        $number = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

        return $province . $letter . '-' . $number;
    }
}
