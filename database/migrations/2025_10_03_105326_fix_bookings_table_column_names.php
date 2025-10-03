<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Rename column to match what controllers expect
            $table->renameColumn('total_amount', 'total_amount_old');
            $table->renameColumn('vehicle_number', 'vehicle_number_old');

            // booking_date already exists, no need to add it
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->renameColumn('total_amount_old', 'total_amount');
            $table->renameColumn('vehicle_number_old', 'vehicle_number');
        });
    }
};
