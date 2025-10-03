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
            // Add missing columns
            $table->foreignId('service_package_id')->nullable()->constrained()->onDelete('set null');
            $table->string('booking_code')->unique()->after('id');
            $table->string('license_plate')->after('vehicle_number');
            $table->string('phone_number')->after('license_plate');
            $table->text('special_requests')->nullable()->after('phone_number');
            $table->decimal('total_cost', 10, 2)->after('total_amount');
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'cancelled', 'pending_verification', 'pending_cash'])->default('pending')->after('status');

            // Add indexes
            $table->index(['service_package_id']);
            $table->index(['booking_code']);
            $table->index(['payment_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['service_package_id']);

            // Drop indexes
            $table->dropIndex(['service_package_id']);
            $table->dropIndex(['booking_code']);
            $table->dropIndex(['payment_status']);

            // Drop columns
            $table->dropColumn([
                'service_package_id',
                'booking_code',
                'license_plate',
                'phone_number',
                'special_requests',
                'total_cost',
                'payment_status'
            ]);
        });
    }
};
