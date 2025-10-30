<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $completed = Booking::where('status', 'completed')->take(60)->get();
        $reviews = [];
        foreach ($completed as $b) {
            $rating = rand(3, 5);
            $reviews[] = [
                'user_id' => $b->user_id,
                'parking_lot_id' => $b->parking_lot_id,
                'booking_id' => $b->id,
                'rating' => $rating,
                'title' => $rating >= 4 ? 'Trải nghiệm tốt' : 'Ổn',
                'comment' => $rating >= 4 ? 'Bãi đỗ xe sạch sẽ và an toàn.' : 'Cần cải thiện một vài điểm.',
                'pros' => $rating >= 4 ? 'An ninh, sạch sẽ' : 'Vị trí thuận tiện',
                'cons' => $rating >= 4 ? 'Ít chỗ giờ cao điểm' : 'Không có mái che',
                'would_recommend' => $rating >= 4,
                'is_verified' => true,
                'status' => 'active',
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now(),
            ];
        }
        foreach (array_chunk($reviews, 100) as $chunk) {
            Review::insert($chunk);
        }
    }
}
