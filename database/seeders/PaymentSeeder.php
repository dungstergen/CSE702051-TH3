<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Booking;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Booking::all();

        if ($bookings->isEmpty()) {
            $this->command->error('Please seed Bookings first!');
            return;
        }

        $paymentMethods = ['e_wallet', 'bank_transfer', 'cash', 'credit_card'];

        foreach ($bookings as $booking) {
            $paymentStatus = $booking->payment_status;
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];

            // Nếu payment_status là completed, set paid_at
            $paidAt = null;
            if ($paymentStatus === 'completed') {
                $paidAt = $booking->created_at->addMinutes(rand(10, 60));
            }

            Payment::create([
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'amount' => $booking->total_cost,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'transaction_id' => $paymentStatus === 'completed' ? 'TXN' . date('YmdHis') . rand(1000, 9999) : null,
                'paid_at' => $paidAt,
                'created_at' => $booking->created_at,
                'updated_at' => $paidAt ?? $booking->updated_at,
            ]);
        }

        $this->command->info('Payments seeded successfully!');
        $this->command->info('Created ' . $bookings->count() . ' payments corresponding to bookings.');
    }
}
