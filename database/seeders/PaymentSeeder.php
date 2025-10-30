<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $completedBookings = Booking::whereIn('status', ['confirmed','completed'])
            ->where('payment_status', 'completed')
            ->get();

        $methods = ['cash', 'e_wallet', 'bank_transfer', 'credit_card'];
        $payments = [];

        foreach ($completedBookings as $b) {
            // Avoid duplicate payments
            if (Payment::where('booking_id', $b->id)->exists()) continue;

            $amount = (float) $b->total_cost * (rand(95, 105) / 100); // small variance
            $paidAt = Carbon::parse($b->start_time)->subMinutes(rand(5, 60));

            $payments[] = [
                'user_id' => $b->user_id,
                'booking_id' => $b->id,
                'amount' => round($amount, 2),
                'payment_method' => $methods[array_rand($methods)],
                'payment_status' => 'completed',
                'transaction_id' => 'TX-' . strtoupper(Str::random(10)),
                'paid_at' => $paidAt,
                'created_at' => $paidAt,
                'updated_at' => $paidAt,
            ];
        }

        foreach (array_chunk($payments, 100) as $chunk) {
            Payment::insert($chunk);
        }
    }
}
