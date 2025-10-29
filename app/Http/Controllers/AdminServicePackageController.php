<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ServicePackage;
use App\Models\Booking;

class AdminServicePackageController extends Controller
{
    public function index(Request $request)
    {
        $query = ServicePackage::query()->withCount(['bookings as usage_count']);

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $packages = $query->orderByDesc('is_featured')->orderBy('name')->paginate(12);

        $stats = [
            'total' => ServicePackage::count(),
            'active' => ServicePackage::where('is_active', true)->count(),
            'inactive' => ServicePackage::where('is_active', false)->count(),
            'featured' => ServicePackage::where('is_featured', true)->count(),
        ];

        return view('admin.service-packages.index', compact('packages', 'stats'));
    }

    public function create()
    {
        return view('admin.service-packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_hours' => 'nullable|integer|min:1',
            'features' => 'nullable|array',
            'features.*' => 'required|string',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'duration_hours' => $validated['duration_hours'] ?? null,
            'features' => $validated['features'] ?? [],
            'is_active' => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
        ];

        ServicePackage::create($data);

        return redirect()->route('admin.service-packages.index')
            ->with('success', 'Gói dịch vụ đã được tạo thành công!');
    }

    public function show(ServicePackage $servicePackage)
    {
        $servicePackage->loadCount(['bookings as usage_count']);
        return view('admin.service-packages.show', ['package' => $servicePackage]);
    }

    public function edit(ServicePackage $servicePackage)
    {
        return view('admin.service-packages.edit', ['package' => $servicePackage]);
    }

    public function update(Request $request, ServicePackage $servicePackage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_hours' => 'nullable|integer|min:1',
            'features' => 'nullable|array',
            'features.*' => 'required|string',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $servicePackage->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'duration_hours' => $validated['duration_hours'] ?? null,
            'features' => $validated['features'] ?? [],
            'is_active' => $request->boolean('is_active', $servicePackage->is_active),
            'is_featured' => $request->boolean('is_featured', $servicePackage->is_featured),
        ]);

        return redirect()->route('admin.service-packages.index')
            ->with('success', 'Gói dịch vụ đã được cập nhật thành công!');
    }

    public function destroy(ServicePackage $servicePackage)
    {
        $servicePackage->delete();
        return redirect()->route('admin.service-packages.index')
            ->with('success', 'Gói dịch vụ đã được xóa thành công!');
    }

    public function toggleStatus(ServicePackage $servicePackage)
    {
        $servicePackage->update(['is_active' => !$servicePackage->is_active]);
        return response()->json([
            'success' => true,
            'message' => 'Trạng thái gói dịch vụ đã được cập nhật!',
            'is_active' => $servicePackage->is_active,
        ]);
    }

    public function toggleFeatured(ServicePackage $servicePackage)
    {
        if (!\Schema::hasColumn('service_packages', 'is_featured')) {
            return response()->json(['success' => false, 'message' => 'Cột is_featured chưa tồn tại'], 422);
        }
        $servicePackage->update(['is_featured' => !$servicePackage->is_featured]);
        return response()->json([
            'success' => true,
            'message' => 'Trạng thái nổi bật đã được cập nhật!',
            'is_featured' => $servicePackage->is_featured,
        ]);
    }
}
