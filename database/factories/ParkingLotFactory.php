<?php

namespace Database\Factories;

use App\Models\ParkingLot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ParkingLot>
 */
class ParkingLotFactory extends Factory
{
    protected $model = ParkingLot::class;

    public function definition(): array
    {
        $facilitiesSets = [
            ['CCTV', 'Bảo vệ 24/7', 'Trạm sạc EV'],
            ['CCTV', 'Bảo vệ 24/7', 'Thang máy', 'Khu vực mái che'],
            ['CCTV', 'Bảo vệ 24/7'],
            ['CCTV', 'Bảo vệ 24/7', 'Hệ thống PCCC'],
        ];

        $totalSpots = $this->faker->numberBetween(80, 200);
        $available = $this->faker->numberBetween(10, $totalSpots);

        return [
            'name' => 'Bãi đỗ xe ' . $this->faker->streetName(),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentence(8),
            'total_spots' => $totalSpots,
            'available_spots' => $available,
            'hourly_rate' => $this->faker->randomFloat(2, 10000, 80000),
            'status' => 'active',
            'latitude' => $this->faker->latitude(20.8, 21.2),
            'longitude' => $this->faker->longitude(105.6, 106.0),
            'facilities' => $this->faker->randomElement($facilitiesSets),
            'contact_phone' => '09' . $this->faker->numberBetween(10000000, 99999999),
            'image' => 'https://picsum.photos/seed/' . $this->faker->uuid() . '/800/600',
        ];
    }
}
