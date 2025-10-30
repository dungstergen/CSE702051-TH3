<?php

namespace Database\Seeders;

use App\Models\ParkingLot;
use App\Models\ServicePackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ParkingLotSeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 parking lots with service packages
        $lots = ParkingLot::factory()->count(5)->create();

        // Create some generic service packages
        $packages = ServicePackage::factory()->count(6)->create();

        // Optionally relate packages to lots if pivot exists in schema
        if (Schema::hasTable('parking_lot_service_packages')) {
            foreach ($packages as $pkg) {
                try {
                    if (method_exists($pkg, 'parkingLots')) {
                        $pkg->parkingLots()->sync($lots->random(rand(2, 4))->pluck('id')->all());
                    }
                } catch (\Throwable $e) {
                    // ignore if relation not defined
                }
            }
        }
    }
}
