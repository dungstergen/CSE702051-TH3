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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('parking_lot_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_package_id')->nullable()->constrained()->onDelete('set null');
            $table->string('booking_code')->unique();
            $table->date('booking_date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('duration_hours');
            $table->string('vehicle_type')->nullable();
            $table->string('license_plate', 20);
            $table->string('phone_number', 15);
            $table->text('special_requests')->nullable();
            $table->decimal('total_cost', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->index(['user_id', 'booking_date']);
            $table->index(['parking_lot_id', 'start_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
