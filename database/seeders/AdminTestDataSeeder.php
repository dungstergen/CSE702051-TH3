<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ParkingLot;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Review;
use Carbon\Carbon;

class AdminTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users
        $users = [
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@gmail.com',
                'phone' => '0901234567',
                'password' => bcrypt('password123'),
                'is_active' => true,
            ],
            [
                'name' => 'Trần Thị B',
                'email' => 'tranthib@gmail.com',
                'phone' => '0912345678',
                'password' => bcrypt('password123'),
                'is_active' => true,
            ],
            [
                'name' => 'Lê Minh C',
                'email' => 'leminhc@gmail.com',
                'phone' => '0923456789',
                'password' => bcrypt('password123'),
                'is_active' => false,
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Create additional users
        User::factory(50)->create();

        // Create parking lots
        $parkingLots = [
            [
                'name' => 'Bãi xe Vincom Center',
                'address' => '72 Lê Thánh Tôn, P. Bến Nghé, Q.1, TP.HCM',
                'description' => 'Bãi xe tầng hầm hiện đại, an ninh tốt',
                'capacity' => 200,
                'hourly_rate' => 15000,
                'latitude' => 10.778526,
                'longitude' => 106.700981,
                'amenities' => 'Camera an ninh, Thang máy, WC, Cửa hàng tiện lợi',
                'operating_hours' => '24/7',
                'contact_info' => '028-3822-4668',
                'is_active' => true,
            ],
            [
                'name' => 'Bãi xe Saigon Centre',
                'address' => '65 Lê Lợi, P. Bến Nghé, Q.1, TP.HCM',
                'description' => 'Vị trí trung tâm, gần các trung tâm thương mại',
                'capacity' => 150,
                'hourly_rate' => 18000,
                'latitude' => 10.773996,
                'longitude' => 106.702225,
                'amenities' => 'Camera CCTV, Bảo vệ 24/7, Thang máy',
                'operating_hours' => '6:00 - 22:00',
                'contact_info' => '028-3829-4888',
                'is_active' => true,
            ],
            [
                'name' => 'Bãi xe Diamond Plaza',
                'address' => '34 Lê Duẩn, P. Bến Nghé, Q.1, TP.HCM',
                'description' => 'Bãi xe cao cấp, phục vụ khách hàng VIP',
                'capacity' => 100,
                'hourly_rate' => 25000,
                'latitude' => 10.779738,
                'longitude' => 106.701318,
                'amenities' => 'Valet Parking, Car Wash, Cafe, WC cao cấp',
                'operating_hours' => '24/7',
                'contact_info' => '028-3825-7777',
                'is_active' => true,
            ],
            [
                'name' => 'Bãi xe Bitexco Financial Tower',
                'address' => '2 Hải Triều, P. Bến Nghé, Q.1, TP.HCM',
                'description' => 'Bãi xe tòa nhà cao nhất Sài Gòn',
                'capacity' => 300,
                'hourly_rate' => 20000,
                'latitude' => 10.771971,
                'longitude' => 106.704407,
                'amenities' => 'Camera AI, Robot parking, EV Charging, Sky Lounge',
                'operating_hours' => '24/7',
                'contact_info' => '028-3914-3301',
                'is_active' => true,
            ]
        ];

        foreach ($parkingLots as $lot) {
            ParkingLot::create($lot);
        }

        // Create additional parking lots
        for ($i = 5; $i <= 12; $i++) {
            ParkingLot::create([
                'name' => "Bãi xe số {$i}",
                'address' => "Địa chỉ {$i}, Quận {$i}, TP.HCM",
                'description' => "Mô tả bãi xe số {$i}",
                'capacity' => rand(50, 250),
                'hourly_rate' => rand(10, 30) * 1000,
                'latitude' => 10.7 + (rand(-100, 100) / 1000),
                'longitude' => 106.7 + (rand(-100, 100) / 1000),
                'amenities' => 'Camera an ninh, Bảo vệ',
                'operating_hours' => rand(0, 1) ? '24/7' : '6:00 - 22:00',
                'contact_info' => '028-' . rand(1000000, 9999999),
                'is_active' => rand(0, 1),
            ]);
        }

        // Create bookings
        $users = User::all();
        $parkingLots = ParkingLot::all();
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];

        for ($i = 0; $i < 100; $i++) {
            $user = $users->random();
            $parkingLot = $parkingLots->random();
            $bookingDate = Carbon::now()->subDays(rand(0, 30));
            $startTime = $bookingDate->copy()->addHours(rand(6, 20));
            $durationHours = rand(1, 8);
            $endTime = $startTime->copy()->addHours($durationHours);

            $booking = Booking::create([
                'user_id' => $user->id,
                'parking_lot_id' => $parkingLot->id,
                'booking_date' => $bookingDate->format('Y-m-d'),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'duration_hours' => $durationHours,
                'total_amount' => $durationHours * $parkingLot->hourly_rate,
                'status' => $statuses[array_rand($statuses)],
                'vehicle_type' => rand(0, 1) ? 'car' : 'motorbike',
                'vehicle_number' => $this->generatePlateNumber(),
                'notes' => rand(0, 1) ? 'Ghi chú đặt chỗ ' . $i : null,
            ]);

            // Create payment for some bookings
            if (rand(0, 2) > 0) { // 2/3 chance
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_amount,
                    'payment_method' => ['credit_card', 'debit_card', 'bank_transfer', 'e_wallet'][array_rand(['credit_card', 'debit_card', 'bank_transfer', 'e_wallet'])],
                    'payment_status' => ['pending', 'completed', 'failed'][array_rand(['pending', 'completed', 'failed'])],
                    'transaction_id' => 'TXN' . strtoupper(uniqid()),
                    'paid_at' => rand(0, 1) ? $startTime->copy()->subMinutes(rand(5, 60)) : null,
                ]);
            }
        }

        // Create reviews
        $completedBookings = Booking::where('status', 'completed')->take(30)->get();

        foreach ($completedBookings as $booking) {
            if (rand(0, 2) > 0) { // 2/3 chance of review
                Review::create([
                    'user_id' => $booking->user_id,
                    'parking_lot_id' => $booking->parking_lot_id,
                    'booking_id' => $booking->id,
                    'rating' => rand(3, 5), // Mostly positive reviews
                    'comment' => $this->generateReviewComment(),
                    'is_visible' => rand(0, 10) > 1, // 90% visible
                ]);
            }
        }

        $this->command->info('Sample data created successfully!');
        $this->command->info('Users: ' . User::count());
        $this->command->info('Parking Lots: ' . ParkingLot::count());
        $this->command->info('Bookings: ' . Booking::count());
        $this->command->info('Payments: ' . Payment::count());
        $this->command->info('Reviews: ' . Review::count());
    }

    private function generatePlateNumber()
    {
        $numbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $letters = chr(rand(65, 90)) . chr(rand(65, 90));
        return "51{$letters}-{$numbers}";
    }

    private function generateReviewComment()
    {
        $comments = [
            'Bãi xe rất sạch sẽ và an toàn. Nhân viên thân thiện.',
            'Vị trí thuận tiện, giá cả hợp lý. Sẽ quay lại lần sau.',
            'Bãi xe rộng rãi, dễ đỗ xe. Hệ thống camera tốt.',
            'Phục vụ nhanh chóng, không phải chờ đợi lâu.',
            'Có mái che, không lo xe bị mưa nắng. Rất hài lòng.',
            'Bảo vệ nhiệt tình, hướng dẫn tận tình.',
            'Giá hơi cao so với mặt bằng chung nhưng chất lượng tốt.',
            'Bãi xe hiện đại, có thang máy tiện lợi.',
            'Gần trung tâm thương mại, rất thuận tiện mua sắm.',
            'Hệ thống đặt chỗ online rất tiện lợi và nhanh chóng.',
        ];

        return $comments[array_rand($comments)];
    }
}
