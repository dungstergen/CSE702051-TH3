<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServicePackage;

class ServicePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Gói Cơ Bản',
                'description' => 'Dịch vụ đỗ xe cơ bản với bảo vệ 24/7',
                'price' => 0,
                'duration_hours' => 1,
                'duration_type' => 'one_time',
                'duration_value' => 1,
                'features' => json_encode([
                    'Bảo vệ 24/7',
                    'Camera an ninh',
                    'Khu vực có mái che'
                ]),
                'max_vehicles' => 1,
                'max_bookings_per_month' => null,
                'discount_percentage' => 0,
                'promotional_price' => null,
                'promotion_start_date' => null,
                'promotion_end_date' => null,
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 1,
                'total_subscribers' => 0
            ],
            [
                'name' => 'Gói VIP',
                'description' => 'Dịch vụ cao cấp với rửa xe miễn phí',
                'price' => 50000,
                'duration_hours' => 2,
                'duration_type' => 'one_time',
                'duration_value' => 1,
                'features' => json_encode([
                    'Rửa xe miễn phí',
                    'Chỗ đỗ VIP gần lối vào',
                    'Dịch vụ hỗ trợ 24/7',
                    'Bảo hiểm xe',
                    'Kiểm tra lốp xe'
                ]),
                'max_vehicles' => 1,
                'max_bookings_per_month' => null,
                'discount_percentage' => 0,
                'promotional_price' => null,
                'promotion_start_date' => null,
                'promotion_end_date' => null,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
                'total_subscribers' => 0
            ],
            [
                'name' => 'Gói Premium',
                'description' => 'Dịch vụ đầy đủ nhất với nhiều tiện ích',
                'price' => 100000,
                'duration_hours' => 4,
                'duration_type' => 'one_time',
                'duration_value' => 1,
                'features' => json_encode([
                    'Rửa xe premium',
                    'Đổ xăng (tùy chọn)',
                    'Chỗ đỗ cao cấp có sạc điện',
                    'Dịch vụ valet parking',
                    'Bảo hiểm toàn diện',
                    'Kiểm tra và bảo dưỡng cơ bản'
                ]),
                'max_vehicles' => 1,
                'max_bookings_per_month' => null,
                'discount_percentage' => 0,
                'promotional_price' => null,
                'promotion_start_date' => null,
                'promotion_end_date' => null,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3,
                'total_subscribers' => 0
            ]
        ];

        foreach ($packages as $package) {
            ServicePackage::create($package);
        }

        $this->command->info('Service packages seeded successfully!');
    }
}
