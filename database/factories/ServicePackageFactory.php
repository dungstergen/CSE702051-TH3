<?php

namespace Database\Factories;

use App\Models\ServicePackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServicePackage>
 */
class ServicePackageFactory extends Factory
{
    protected $model = ServicePackage::class;

    public function definition(): array
    {
        $durations = [1, 2, 4, 8, 12, 24];
        $featuresCatalog = [
            'Giữ xe qua đêm',
            'Rửa xe miễn phí',
            'Giữ chỗ ưu tiên',
            'Hỗ trợ 24/7',
            'Giảm giá giờ cao điểm',
        ];
        shuffle($featuresCatalog);
        $features = array_slice($featuresCatalog, 0, rand(2, 4));

        return [
            'name' => 'Gói ' . $this->faker->randomElement(['Basic','Standard','Premium','VIP']) . ' ' . $this->faker->randomElement($durations) . 'h',
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 30000, 300000),
            'duration_hours' => $this->faker->randomElement($durations),
            'features' => $features,
            'is_active' => true,
        ];
    }
}
