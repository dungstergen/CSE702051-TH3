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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('parking_lot_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
            $table->tinyInteger('rating')->unsigned();
            $table->text('comment')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->text('admin_note')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['user_id']);
            $table->index(['parking_lot_id']);
            $table->index(['booking_id']);
            $table->index(['rating']);
            $table->index(['is_visible']);

            // Note: SQLite doesn't support CHECK constraints in Laravel migrations
            // Validation will be handled in the model
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
