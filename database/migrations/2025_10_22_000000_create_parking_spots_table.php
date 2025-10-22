<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_lot_id')
                  ->constrained('parking_lots')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->string('spot_code', 50);
            $table->string('level', 20)->nullable();
            $table->enum('status', ['available','occupied','reserved','maintenance'])
                  ->default('available');
            $table->enum('vehicle_type', ['car','motorbike','truck'])->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unique(['parking_lot_id', 'spot_code']);
            $table->index(['parking_lot_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_spots');
    }
};
