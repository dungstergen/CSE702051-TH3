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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('number', 20); // Biển số xe: 29A-12345
            $table->enum('type', ['car', 'motorbike', 'truck']); // Loại xe
            $table->string('brand', 50)->nullable(); // Nhãn hiệu: Honda, Toyota
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->unique(['user_id', 'number']); // Không cho phép trùng biển số cho cùng 1 user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
