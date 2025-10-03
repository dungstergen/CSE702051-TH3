<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = [
            (object) [
                'id' => 1,
                'name' => 'Nguyễn Văn An',
                'email' => 'nguyenvanan@email.com',
                'phone' => '0901234567',
                'content' => 'Dịch vụ gửi xe rất tuyệt vời! Nhân viên chuyên nghiệp, bãi xe sạch sẽ và an toàn. Tôi đã sử dụng dịch vụ được 6 tháng và rất hài lòng.',
                'rating' => 5,
                'status' => 'published',
                'is_featured' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1),
            ],
            (object) [
                'id' => 2,
                'name' => 'Trần Thị Lan',
                'email' => 'tranthilan@email.com',
                'phone' => '0987654321',
                'content' => 'Bãi xe rộng rãi, có mái che, camera an ninh đầy đủ. Giá cả hợp lý so với chất lượng dịch vụ. Rất khuyến khích mọi người sử dụng.',
                'rating' => 4,
                'status' => 'published',
                'is_featured' => false,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
            ],
            (object) [
                'id' => 3,
                'name' => 'Lê Quang Minh',
                'email' => 'lequangminh@email.com',
                'phone' => '0912345678',
                'content' => 'Lần đầu sử dụng dịch vụ, cảm thấy rất ấn tượng với sự chuyên nghiệp của đội ngũ. Xe được bảo quản tốt, không có xước xát gì.',
                'rating' => 5,
                'status' => 'pending',
                'is_featured' => false,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            (object) [
                'id' => 4,
                'name' => 'Phạm Thị Hoa',
                'email' => 'phamthihoa@email.com',
                'phone' => '0923456789',
                'content' => 'Dịch vụ valet parking rất tiện lợi, tiết kiệm được rất nhiều thời gian. Nhân viên lịch sự và có trách nhiệm.',
                'rating' => 4,
                'status' => 'published',
                'is_featured' => true,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(4),
            ],
            (object) [
                'id' => 5,
                'name' => 'Hoàng Văn Đức',
                'email' => 'hoangvanduc@email.com',
                'phone' => '0934567890',
                'content' => 'Tôi đã thử nhiều bãi xe khác nhưng chỉ có ở đây là tôi cảm thấy yên tâm nhất. Hệ thống bảo mật tốt, giá cả minh bạch.',
                'rating' => 5,
                'status' => 'rejected',
                'is_featured' => false,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(8),
            ],
        ];

        $stats = [
            'total' => count($testimonials),
            'published' => collect($testimonials)->where('status', 'published')->count(),
            'pending' => collect($testimonials)->where('status', 'pending')->count(),
            'rejected' => collect($testimonials)->where('status', 'rejected')->count(),
            'featured' => collect($testimonials)->where('is_featured', true)->count(),
            'average_rating' => collect($testimonials)->avg('rating'),
        ];

        return view('admin.testimonials.index', compact('testimonials', 'stats'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|max:20',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // In a real application, you would save to database here
        // Testimonial::create($request->all());

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Đánh giá đã được tạo thành công!');
    }

    public function show($id)
    {
        // Simulate finding a testimonial
        $testimonial = (object) [
            'id' => $id,
            'name' => 'Nguyễn Văn An',
            'email' => 'nguyenvanan@email.com',
            'phone' => '0901234567',
            'content' => 'Dịch vụ gửi xe rất tuyệt vời! Nhân viên chuyên nghiệp, bãi xe sạch sẽ và an toàn. Tôi đã sử dụng dịch vụ được 6 tháng và rất hài lòng.',
            'rating' => 5,
            'status' => 'published',
            'is_featured' => true,
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(1),
        ];

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit($id)
    {
        // Simulate finding a testimonial
        $testimonial = (object) [
            'id' => $id,
            'name' => 'Nguyễn Văn An',
            'email' => 'nguyenvanan@email.com',
            'phone' => '0901234567',
            'content' => 'Dịch vụ gửi xe rất tuyệt vời! Nhân viên chuyên nghiệp, bãi xe sạch sẽ và an toàn. Tôi đã sử dụng dịch vụ được 6 tháng và rất hài lòng.',
            'rating' => 5,
            'status' => 'published',
            'is_featured' => true,
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(1),
        ];

        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|max:20',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // In a real application, you would update the database record here
        // $testimonial = Testimonial::findOrFail($id);
        // $testimonial->update($request->all());

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Đánh giá đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        // In a real application, you would delete from database here
        // Testimonial::findOrFail($id)->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Đánh giá đã được xóa thành công!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,published,rejected'
        ]);

        // In a real application, you would update the status in database
        // $testimonial = Testimonial::findOrFail($id);
        // $testimonial->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái đánh giá đã được cập nhật!'
        ]);
    }

    public function toggleFeatured($id)
    {
        // In a real application, you would toggle the featured status in database
        // $testimonial = Testimonial::findOrFail($id);
        // $testimonial->update(['is_featured' => !$testimonial->is_featured]);

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái nổi bật đã được cập nhật!'
        ]);
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,reject,delete,feature,unfeature',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'integer'
        ]);

        $action = $request->action;
        $ids = $request->selected_ids;

        // In a real application, you would perform bulk operations here
        // switch ($action) {
        //     case 'publish':
        //         Testimonial::whereIn('id', $ids)->update(['status' => 'published']);
        //         break;
        //     case 'reject':
        //         Testimonial::whereIn('id', $ids)->update(['status' => 'rejected']);
        //         break;
        //     case 'delete':
        //         Testimonial::whereIn('id', $ids)->delete();
        //         break;
        //     case 'feature':
        //         Testimonial::whereIn('id', $ids)->update(['is_featured' => true]);
        //         break;
        //     case 'unfeature':
        //         Testimonial::whereIn('id', $ids)->update(['is_featured' => false]);
        //         break;
        // }

        $actionMessages = [
            'publish' => 'đã được xuất bản',
            'reject' => 'đã bị từ chối',
            'delete' => 'đã được xóa',
            'feature' => 'đã được đánh dấu nổi bật',
            'unfeature' => 'đã bỏ đánh dấu nổi bật'
        ];

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' đánh giá ' . $actionMessages[$action] . ' thành công!'
        ]);
    }
}
