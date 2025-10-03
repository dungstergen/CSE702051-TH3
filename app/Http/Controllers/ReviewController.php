<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;
use App\Models\ParkingLot;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display user's reviews
     */
    public function index()
    {
        $user = Auth::user();

        $reviews = Review::where('user_id', $user->id)
            ->with(['parkingLot', 'booking'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get eligible bookings for review (completed and not reviewed)
        $eligibleBookings = Booking::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->with('parkingLot')
            ->orderBy('end_time', 'desc')
            ->limit(5)
            ->get();

        return view('user.reviews', compact('reviews', 'eligibleBookings'));
    }

    /**
     * Show create review form
     */
    public function create(Request $request)
    {
        $bookingId = $request->query('booking_id');

        if (!$bookingId) {
            return redirect()->route('user.reviews')->withErrors(['error' => 'Không tìm thấy thông tin đặt chỗ']);
        }

        $booking = Booking::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->with('parkingLot')
            ->findOrFail($bookingId);

        return view('user.review-create', compact('booking'));
    }

    /**
     * Store a new review
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:200',
            'comment' => 'required|string|max:1000',
            'pros' => 'nullable|string|max:500',
            'cons' => 'nullable|string|max:500',
            'would_recommend' => 'required|boolean'
        ], [
            'booking_id.required' => 'Không tìm thấy thông tin đặt chỗ',
            'booking_id.exists' => 'Thông tin đặt chỗ không hợp lệ',
            'parking_lot_id.required' => 'Không tìm thấy thông tin bãi đỗ xe',
            'parking_lot_id.exists' => 'Thông tin bãi đỗ xe không hợp lệ',
            'rating.required' => 'Vui lòng chọn số sao đánh giá',
            'rating.min' => 'Số sao đánh giá phải từ 1 đến 5',
            'rating.max' => 'Số sao đánh giá phải từ 1 đến 5',
            'title.required' => 'Vui lòng nhập tiêu đề đánh giá',
            'title.max' => 'Tiêu đề không được quá 200 ký tự',
            'comment.required' => 'Vui lòng nhập nội dung đánh giá',
            'comment.max' => 'Nội dung đánh giá không được quá 1000 ký tự',
            'pros.max' => 'Điểm tốt không được quá 500 ký tự',
            'cons.max' => 'Điểm cần cải thiện không được quá 500 ký tự',
            'would_recommend.required' => 'Vui lòng chọn có giới thiệu cho người khác hay không'
        ]);

        $user = Auth::user();

        // Verify booking belongs to user and is completed
        $booking = Booking::where('user_id', $user->id)
            ->where('id', $request->booking_id)
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->first();

        if (!$booking) {
            return back()->withErrors(['error' => 'Đặt chỗ không hợp lệ hoặc đã được đánh giá']);
        }

        // Create review
        $review = Review::create([
            'user_id' => $user->id,
            'booking_id' => $request->booking_id,
            'parking_lot_id' => $request->parking_lot_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'pros' => $request->pros,
            'cons' => $request->cons,
            'would_recommend' => $request->would_recommend,
            'is_verified' => true, // Since it's from a completed booking
            'status' => 'active'
        ]);

        return redirect()->route('user.reviews')
            ->with('success', 'Cảm ơn bạn đã đánh giá! Đánh giá của bạn sẽ giúp cải thiện chất lượng dịch vụ.');
    }

    /**
     * Show review details
     */
    public function show($id)
    {
        $review = Review::where('user_id', Auth::id())
            ->with(['parkingLot', 'booking'])
            ->findOrFail($id);

        return view('user.review-show', compact('review'));
    }

    /**
     * Show edit review form
     */
    public function edit($id)
    {
        $review = Review::where('user_id', Auth::id())
            ->with(['parkingLot', 'booking'])
            ->findOrFail($id);

        // Only allow editing within 7 days
        if ($review->created_at->addDays(7)->isPast()) {
            return redirect()->route('user.reviews')
                ->withErrors(['error' => 'Chỉ có thể chỉnh sửa đánh giá trong vòng 7 ngày']);
        }

        return view('user.review-edit', compact('review'));
    }

    /**
     * Update review
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:200',
            'comment' => 'required|string|max:1000',
            'pros' => 'nullable|string|max:500',
            'cons' => 'nullable|string|max:500',
            'would_recommend' => 'required|boolean'
        ]);

        $review = Review::where('user_id', Auth::id())->findOrFail($id);

        // Only allow editing within 7 days
        if ($review->created_at->addDays(7)->isPast()) {
            return back()->withErrors(['error' => 'Chỉ có thể chỉnh sửa đánh giá trong vòng 7 ngày']);
        }

        $review->update([
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'pros' => $request->pros,
            'cons' => $request->cons,
            'would_recommend' => $request->would_recommend
        ]);

        return redirect()->route('user.reviews')
            ->with('success', 'Đánh giá đã được cập nhật thành công');
    }

    /**
     * Delete review
     */
    public function destroy($id)
    {
        $review = Review::where('user_id', Auth::id())->findOrFail($id);

        // Only allow deletion within 24 hours
        if ($review->created_at->addHours(24)->isPast()) {
            return back()->withErrors(['error' => 'Chỉ có thể xóa đánh giá trong vòng 24 giờ']);
        }

        $review->delete();

        return redirect()->route('user.reviews')
            ->with('success', 'Đánh giá đã được xóa thành công');
    }
}
