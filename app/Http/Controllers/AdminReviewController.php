<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of reviews
     */
    public function index(Request $request)
    {
        $query = Review::with(['user', 'parkingLot']);

        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Filter by visibility
        if ($request->filled('visibility')) {
            $query->where('is_visible', $request->visibility === 'visible');
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('comment', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($userQuery) use ($request) {
                      $userQuery->where('name', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('parkingLot', function($lotQuery) use ($request) {
                      $lotQuery->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get parking lots for filter dropdown
        $parkingLots = \App\Models\ParkingLot::all();

        return view('admin.reviews.index', compact('reviews', 'parkingLots'));
    }

    /**
     * Display the specified review
     */
    public function show(Review $review)
    {
        $review->load(['user', 'parkingLot']);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified review
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified review
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'is_visible' => 'boolean',
            'admin_note' => 'nullable|string'
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        $review->update($validated);

        return redirect()->route('admin.reviews.index')
                        ->with('success', 'Cập nhật đánh giá thành công!');
    }

    /**
     * Remove the specified review
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
                        ->with('success', 'Xóa đánh giá thành công!');
    }

    /**
     * Toggle review visibility
     */
    public function toggleVisibility(Review $review)
    {
        $review->update(['is_visible' => !$review->is_visible]);

        $status = $review->is_visible ? 'hiển thị' : 'ẩn';

        return redirect()->route('admin.reviews.index')
                        ->with('success', "Đã {$status} đánh giá thành công!");
    }

    /**
     * Bulk actions for reviews
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:show,hide,delete',
            'review_ids' => 'required|array',
            'review_ids.*' => 'exists:reviews,id'
        ]);

        $reviews = Review::whereIn('id', $validated['review_ids']);

        switch ($validated['action']) {
            case 'show':
                $reviews->update(['is_visible' => true]);
                $message = 'Đã hiển thị các đánh giá được chọn!';
                break;
            case 'hide':
                $reviews->update(['is_visible' => false]);
                $message = 'Đã ẩn các đánh giá được chọn!';
                break;
            case 'delete':
                $reviews->delete();
                $message = 'Đã xóa các đánh giá được chọn!';
                break;
        }

        return redirect()->route('admin.reviews.index')
                        ->with('success', $message);
    }
}
