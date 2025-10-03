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
        Schema::table('service_packages', function (Blueprint $table) {
            // Replace status with is_active (controller expects is_active)
            $table->dropColumn('status');
            $table->boolean('is_active')->default(true)->after('features');

            // Add missing columns
            $table->enum('duration_type', ['one_time', 'hourly', 'daily', 'weekly', 'monthly'])->default('one_time')->after('duration_hours');
            $table->integer('duration_value')->default(1)->after('duration_type');
            $table->integer('max_vehicles')->default(1)->after('is_active');
            $table->integer('max_bookings_per_month')->nullable()->after('max_vehicles');
            $table->decimal('discount_percentage', 5, 2)->default(0)->after('max_bookings_per_month');
            $table->decimal('promotional_price', 10, 2)->nullable()->after('discount_percentage');
            $table->date('promotion_start_date')->nullable()->after('promotional_price');
            $table->date('promotion_end_date')->nullable()->after('promotion_start_date');
            $table->integer('sort_order')->default(0)->after('is_featured');
            $table->integer('total_subscribers')->default(0)->after('sort_order');

            // Add indexes
            $table->index(['is_active']);
            $table->index(['is_featured']);
            $table->index(['sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_packages', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex(['is_active']);
            $table->dropIndex(['is_featured']);
            $table->dropIndex(['sort_order']);

            // Drop columns and restore status
            $table->dropColumn([
                'is_active',
                'duration_type',
                'duration_value',
                'max_vehicles',
                'max_bookings_per_month',
                'discount_percentage',
                'promotional_price',
                'promotion_start_date',
                'promotion_end_date',
                'sort_order',
                'total_subscribers'
            ]);

            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }
};
