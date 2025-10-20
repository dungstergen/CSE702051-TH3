<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Booking;
use App\Models\User;
use App\Models\ParkingLot;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Chỉ tạo review cho các booking đã completed
        $completedBookings = Booking::where('status', 'completed')->get();

        if ($completedBookings->isEmpty()) {
            $this->command->warn('No completed bookings found. Reviews will be limited.');
            return;
        }

        $comments = [
            [
                'rating' => 5,
                'comment' => 'Bãi đỗ xe rất tốt, an toàn và tiện lợi. Nhân viên thân thiện, giá cả hợp lý. Tôi sẽ quay lại!',
            ],
            [
                'rating' => 4,
                'comment' => 'Bãi đỗ xe khá ổn, có camera an ninh. Tuy nhiên đôi khi hơi đông người vào cuối tuần.',
            ],
            [
                'rating' => 5,
                'comment' => 'Rất hài lòng với dịch vụ! Bảo vệ nhiệt tình, bãi xe sạch sẽ, có mái che tốt.',
            ],
            [
                'rating' => 3,
                'comment' => 'Bãi xe tạm ổn, giá hơi cao so với mặt bằng chung. Vị trí thuận tiện.',
            ],
            [
                'rating' => 4,
                'comment' => 'Bãi xe khá tốt, gần trung tâm. Thỉnh thoảng hơi khó tìm chỗ đỗ vào giờ cao điểm.',
            ],
            [
                'rating' => 5,
                'comment' => 'Xuất sắc! An ninh tốt, giá cả phải chăng, gần chợ và siêu thị. Rất tiện lợi!',
            ],
            [
                'rating' => 4,
                'comment' => 'Dịch vụ tốt, nhân viên chuyên nghiệp. Bãi xe rộng rãi và sạch sẽ.',
            ],
            [
                'rating' => 5,
                'comment' => 'Tuyệt vời! Bãi xe hiện đại, có app đặt chỗ trước rất tiện. Giá hợp lý.',
            ],
            [
                'rating' => 3,
                'comment' => 'Bình thường, không có gì đặc biệt. Giá hơi cao nhưng vị trí đẹp.',
            ],
            [
                'rating' => 4,
                'comment' => 'Khá hài lòng. Bãi xe an toàn, có camera giám sát 24/7. Sẽ quay lại!',
            ],
        ];

        // Tạo review cho 70% số booking completed
        $reviewCount = (int)($completedBookings->count() * 0.7);
        $bookingsToReview = $completedBookings->random(min($reviewCount, $completedBookings->count()));

        foreach ($bookingsToReview as $booking) {
            $commentData = $comments[array_rand($comments)];

            Review::create([
                'user_id' => $booking->user_id,
                'parking_lot_id' => $booking->parking_lot_id,
                'booking_id' => $booking->id,
                'rating' => $commentData['rating'],
                'title' => 'Đánh giá bãi đỗ xe',
                'comment' => $commentData['comment'],
                'would_recommend' => $commentData['rating'] >= 4,
                'is_verified' => true,
                'status' => 'active',
                'created_at' => $booking->end_time->addHours(rand(1, 48)),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Reviews seeded successfully!');
        $this->command->info('Created ' . $bookingsToReview->count() . ' reviews for completed bookings.');
    }
}
