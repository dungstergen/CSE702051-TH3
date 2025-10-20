<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;
use App\Models\ParkingLot;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Danh sách đánh giá của user
    public function index()
    {
        $reviews = Review::where('user_id', Auth::id())
            ->with(['parkingLot', 'booking'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $eligibleBookings = Booking::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->with('parkingLot')
            ->orderBy('end_time', 'desc')
            ->limit(5)
            ->get();

        return view('user.reviews', compact('reviews', 'eligibleBookings'));
    }

    // Form tạo đánh giá
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

    // Lưu đánh giá mới
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
        ]);

        // Kiểm tra booking hợp lệ
        $booking = Booking::where('user_id', Auth::id())
            ->where('id', $request->booking_id)
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->first();


        if (!$booking) {
            return back()->withErrors(['error' => 'Đặt chỗ không hợp lệ hoặc đã được đánh giá']);
        }

        // Tạo review
        Review::create([
            'user_id' => Auth::id(),
            'booking_id' => $request->booking_id,
            'parking_lot_id' => $request->parking_lot_id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'pros' => $request->pros,
            'cons' => $request->cons,
            'would_recommend' => $request->would_recommend,
            'is_verified' => true,
            'status' => 'active'
        ]);

        return redirect()->route('user.reviews')
            ->with('success', 'Cảm ơn bạn đã đánh giá!');
    }

    // Xem chi tiết đánh giá
    public function show($id)
    {
        $review = Review::where('user_id', Auth::id())
            ->with(['parkingLot', 'booking'])
            ->findOrFail($id);

        return view('user.review-show', compact('review'));
    }

    // Form chỉnh sửa
    public function edit($id)
    {
        $review = Review::where('user_id', Auth::id())
            ->with(['parkingLot', 'booking'])
            ->findOrFail($id);

        if ($review->created_at->addDays(7)->isPast()) {
            return redirect()->route('user.reviews')
                ->withErrors(['error' => 'Chỉ có thể chỉnh sửa trong vòng 7 ngày']);
        }

        return view('user.review-edit', compact('review'));
    }

    // Cập nhật đánh giá
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

        if ($review->created_at->addDays(7)->isPast()) {
            return back()->withErrors(['error' => 'Chỉ có thể chỉnh sửa trong vòng 7 ngày']);
        }

        $review->update($request->only(['rating', 'title', 'comment', 'pros', 'cons', 'would_recommend']));

        return redirect()->route('user.reviews')->with('success', 'Đánh giá đã được cập nhật');
    }

    // Xóa đánh giá
    public function destroy($id)
    {
        $review = Review::where('user_id', Auth::id())->findOrFail($id);

        if ($review->created_at->addHours(24)->isPast()) {
            return back()->withErrors(['error' => 'Chỉ có thể xóa trong vòng 24 giờ']);
        }

        $review->delete();

        return redirect()->route('user.reviews')->with('success', 'Đánh giá đã được xóa');
    }
}
