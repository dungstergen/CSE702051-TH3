<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminServicePackageController extends Controller
{
    public function index()
    {
        $packages = [
            (object) [
                'id' => 1,
                'name' => 'Gói Cơ Bản',
                'price' => 50000,
                'duration' => '1 tháng',
                'features' => ['Gửi xe 24/7', 'Bảo vệ cơ bản', 'Rửa xe 1 lần/tuần'],
                'is_active' => true,
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object) [
                'id' => 2,
                'name' => 'Gói Tiêu Chuẩn',
                'price' => 100000,
                'duration' => '1 tháng',
                'features' => ['Gửi xe 24/7', 'Bảo vệ nâng cao', 'Rửa xe 2 lần/tuần', 'Bảo dưỡng cơ bản'],
                'is_active' => true,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            (object) [
                'id' => 3,
                'name' => 'Gói Cao Cấp',
                'price' => 150000,
                'duration' => '1 tháng',
                'features' => ['Gửi xe 24/7', 'Bảo vệ VIP', 'Rửa xe hàng ngày', 'Bảo dưỡng định kỳ', 'Valet parking'],
                'is_active' => true,
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $stats = [
            'total' => count($packages),
            'active' => collect($packages)->where('is_active', true)->count(),
            'featured' => collect($packages)->where('is_featured', true)->count(),
            'inactive' => collect($packages)->where('is_active', false)->count(),
        ];

        return view('admin.service-packages.index', compact('packages', 'stats'));
    }

    public function create()
    {
        return view('admin.service-packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|max:255',
            'features' => 'required|array',
            'features.*' => 'required|string',
        ]);

        // In a real application, you would save to database here
        // ServicePackage::create($request->all());

        return redirect()->route('admin.service-packages.index')
            ->with('success', 'Gói dịch vụ đã được tạo thành công!');
    }

    public function show($id)
    {
        // Simulate finding a service package
        $package = (object) [
            'id' => $id,
            'name' => 'Gói Tiêu Chuẩn',
            'price' => 100000,
            'duration' => '1 tháng',
            'features' => ['Gửi xe 24/7', 'Bảo vệ nâng cao', 'Rửa xe 2 lần/tuần', 'Bảo dưỡng cơ bản'],
            'is_active' => true,
            'is_featured' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        return view('admin.service-packages.show', compact('package'));
    }

    public function edit($id)
    {
        // Simulate finding a service package
        $package = (object) [
            'id' => $id,
            'name' => 'Gói Tiêu Chuẩn',
            'price' => 100000,
            'duration' => '1 tháng',
            'features' => ['Gửi xe 24/7', 'Bảo vệ nâng cao', 'Rửa xe 2 lần/tuần', 'Bảo dưỡng cơ bản'],
            'is_active' => true,
            'is_featured' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        return view('admin.service-packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|max:255',
            'features' => 'required|array',
            'features.*' => 'required|string',
        ]);

        // In a real application, you would update the database record here
        // $package = ServicePackage::findOrFail($id);
        // $package->update($request->all());

        return redirect()->route('admin.service-packages.index')
            ->with('success', 'Gói dịch vụ đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        // In a real application, you would delete from database here
        // ServicePackage::findOrFail($id)->delete();

        return redirect()->route('admin.service-packages.index')
            ->with('success', 'Gói dịch vụ đã được xóa thành công!');
    }

    public function toggleStatus($id)
    {
        // In a real application, you would toggle the status in database
        // $package = ServicePackage::findOrFail($id);
        // $package->update(['is_active' => !$package->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái gói dịch vụ đã được cập nhật!'
        ]);
    }

    public function toggleFeatured($id)
    {
        // In a real application, you would toggle the featured status in database
        // $package = ServicePackage::findOrFail($id);
        // $package->update(['is_featured' => !$package->is_featured]);

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái nổi bật đã được cập nhật!'
        ]);
    }
}
