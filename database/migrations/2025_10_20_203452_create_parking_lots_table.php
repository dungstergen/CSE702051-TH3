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
        Schema::create('parking_lots', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('address');
            $table->text('description');
            $table->integer('total_spots');
            $table->integer('available_spots');
            $table->decimal('hourly_rate', 10, 2);
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->json('facilities');
            $table->string('contact_phone', 20);
            $table->string('image', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_lots');
    }
};
