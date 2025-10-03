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
        Schema::table('parking_lots', function (Blueprint $table) {
            // Add missing columns
            $table->integer('total_spots')->after('capacity');
            $table->integer('available_spots')->after('total_spots');
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active')->after('is_active');
            $table->text('facilities')->nullable()->after('amenities');

            // Add indexes
            $table->index(['status']);
            $table->index(['available_spots']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parking_lots', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex(['status']);
            $table->dropIndex(['available_spots']);

            // Drop columns
            $table->dropColumn([
                'total_spots',
                'available_spots',
                'status',
                'facilities'
            ]);
        });
    }
};
