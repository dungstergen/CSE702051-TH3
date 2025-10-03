<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingLot;

class AdminParkingLotController extends Controller
{
    /**
     * Display a listing of parking lots
     */
    public function index(Request $request)
    {
        $query = ParkingLot::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $parkingLots = $query->withCount('bookings')
                            ->orderBy('created_at', 'desc')
                            ->paginate(20);

        return view('admin.parking-lots.index', compact('parkingLots'));
    }

    /**
     * Show the form for creating a new parking lot
     */
    public function create()
    {
        return view('admin.parking-lots.create');
    }

    /**
     * Store a newly created parking lot
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'hourly_rate' => 'required|numeric|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'amenities' => 'nullable|string',
            'operating_hours' => 'nullable|string',
            'contact_info' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        ParkingLot::create($validated);

        return redirect()->route('admin.parking-lots.index')
                        ->with('success', 'Tạo bãi đỗ xe thành công!');
    }

    /**
     * Display the specified parking lot
     */
    public function show(ParkingLot $parkingLot)
    {
        $parkingLot->load(['bookings.user', 'reviews.user']);

        return view('admin.parking-lots.show', compact('parkingLot'));
    }

    /**
     * Show the form for editing the specified parking lot
     */
    public function edit(ParkingLot $parkingLot)
    {
        return view('admin.parking-lots.edit', compact('parkingLot'));
    }

    /**
     * Update the specified parking lot
     */
    public function update(Request $request, ParkingLot $parkingLot)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'hourly_rate' => 'required|numeric|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'amenities' => 'nullable|string',
            'operating_hours' => 'nullable|string',
            'contact_info' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $parkingLot->update($validated);

        return redirect()->route('admin.parking-lots.index')
                        ->with('success', 'Cập nhật bãi đỗ xe thành công!');
    }

    /**
     * Remove the specified parking lot
     */
    public function destroy(ParkingLot $parkingLot)
    {
        // Check if parking lot has active bookings
        if ($parkingLot->bookings()->whereIn('status', ['pending', 'confirmed'])->count() > 0) {
            return redirect()->route('admin.parking-lots.index')
                            ->with('error', 'Không thể xóa bãi đỗ xe có đặt chỗ đang hoạt động!');
        }

        $parkingLot->delete();

        return redirect()->route('admin.parking-lots.index')
                        ->with('success', 'Xóa bãi đỗ xe thành công!');
    }

    /**
     * Toggle parking lot status
     */
    public function toggleStatus(ParkingLot $parkingLot)
    {
        $parkingLot->update(['is_active' => !$parkingLot->is_active]);

        $status = $parkingLot->is_active ? 'kích hoạt' : 'vô hiệu hóa';

        return redirect()->route('admin.parking-lots.index')
                        ->with('success', "Đã {$status} bãi đỗ xe thành công!");
    }
}
