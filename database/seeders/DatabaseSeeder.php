<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Thứ tự quan trọng: ParkingLot và User trước, sau đó Booking, Payment, Review
            ParkingLotSeeder::class,
            UserSeeder::class,
            BookingSeeder::class,
            PaymentSeeder::class,
            ReviewSeeder::class,
            // AdminTestDataSeeder::class, // Tắt vì dùng cột is_active không tồn tại
        ]);
    }
}
