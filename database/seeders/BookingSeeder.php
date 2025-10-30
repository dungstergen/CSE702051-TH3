<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\ParkingLot;
use App\Models\ServicePackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereHas('roles', fn($q) => $q->where('name', 'user'))->get();
        if ($users->isEmpty()) { $users = User::factory(10)->create(); }
        $lots = ParkingLot::all();
        $packages = ServicePackage::all();

        $faker = fake();
        $statuses = ['pending','confirmed','cancelled','completed'];
        $vehicleTypes = ['car','motorbike'];

        $bookings = [];
        // Generate ~200 bookings over last 60 days
        for ($i = 0; $i < 200; $i++) {
            $user = $users->random();
            $lot = $lots->random();
            $package = $packages->random();

            $start = Carbon::now()->subDays(rand(0, 60))->setTime(rand(6, 22), [0, 15, 30, 45][rand(0, 3)], 0);
            $duration = [1,2,3,4,6,8][array_rand([1,2,3,4,6,8])];
            $end = (clone $start)->addHours($duration);
            $status = $statuses[array_rand($statuses)];
            if ($start->isFuture()) { $status = 'pending'; }

            $total = round(((float)$lot->hourly_rate) * $duration, 2);

            $bookings[] = [
                'user_id' => $user->id,
                'parking_lot_id' => $lot->id,
                'service_package_id' => $package->id,
                'booking_code' => 'BK-' . strtoupper(Str::random(8)),
                'booking_date' => $start->toDateString(),
                'start_time' => $start->toDateTimeString(),
                'end_time' => $end->toDateTimeString(),
                'duration_hours' => $duration,
                'vehicle_type' => $vehicleTypes[array_rand($vehicleTypes)],
                'license_plate' => strtoupper(Str::random(2)) . '-' . rand(10000, 99999),
                'phone_number' => '09' . rand(10000000, 99999999),
                'special_requests' => $faker->boolean(20) ? $faker->sentence() : null,
                'total_cost' => $total,
                'status' => $status,
                'payment_status' => in_array($status, ['confirmed','completed']) ? 'completed' : 'pending',
                'created_at' => $start->copy()->subMinutes(rand(10, 240)),
                'updated_at' => $end,
            ];
        }

        foreach (array_chunk($bookings, 50) as $chunk) {
            Booking::insert($chunk);
        }
    }
}
