<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingLotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parkingLots = [
            [
                'name' => 'Bãi Đỗ Xe Trung Tâm',
                'address' => '123 Đường Nguyễn Huệ, Quận 1, TP.HCM',
                'description' => 'Bãi đỗ xe hiện đại tại trung tâm thành phố',
                'total_spots' => 100,
                'available_spots' => 85,
                'hourly_rate' => 15000,
                'latitude' => 10.7769,
                'longitude' => 106.7009,
                'status' => 'active',
                'facilities' => json_encode(['Camera an ninh', 'Bảo vệ 24/7', 'Có mái che', 'Gần trung tâm']),
                'contact_phone' => '0901234567',
            ],
            [
                'name' => 'Bãi Đỗ Xe Sân Bay',
                'address' => 'Sân Bay Tân Sơn Nhất, TP.HCM',
                'description' => 'Bãi đỗ xe phục vụ hành khách sân bay',
                'total_spots' => 200,
                'available_spots' => 150,
                'hourly_rate' => 20000,
                'latitude' => 10.8188,
                'longitude' => 106.6519,
                'status' => 'active',
                'facilities' => json_encode(['Hoạt động 24/7', 'Gần sân bay', 'An ninh cao', 'Xe bus đưa đón']),
                'contact_phone' => '0901234568',
            ],
            [
                'name' => 'Bãi Đỗ Xe Quận 7',
                'address' => '456 Nguyễn Thị Thập, Quận 7, TP.HCM',
                'description' => 'Bãi đỗ xe tiện lợi tại khu vực Phú Mỹ Hưng',
                'total_spots' => 80,
                'available_spots' => 60,
                'hourly_rate' => 12000,
                'latitude' => 10.7406,
                'longitude' => 106.7208,
                'status' => 'active',
                'facilities' => json_encode(['Giá cả hợp lý', 'Khu vực an toàn', 'Gần khu dân cư']),
                'contact_phone' => '0901234569',
            ]
        ];

        foreach ($parkingLots as $lot) {
            \App\Models\ParkingLot::create($lot);
        }

        $this->command->info('Parking lots seeded successfully!');
    }
}
