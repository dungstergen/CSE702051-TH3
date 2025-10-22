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
            $query->where('status', $request->status);
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
            'address' => 'required|string',
            'description' => 'nullable|string',
            'total_spots' => 'required|integer|min:1',
            'available_spots' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,maintenance',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'facilities' => 'nullable|array',
            'contact_phone' => 'nullable|string|max:20',
            'image' => 'nullable|string|max:255',
        ]);
        if (isset($validated['facilities']) && is_array($validated['facilities'])) {
            $validated['facilities'] = json_encode($validated['facilities']);
        }
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
            'address' => 'required|string',
            'description' => 'nullable|string',
            'total_spots' => 'required|integer|min:1',
            'available_spots' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive,maintenance',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'facilities' => 'nullable|array',
            'contact_phone' => 'nullable|string|max:20',
            'image' => 'nullable|string|max:255',
        ]);
        if (isset($validated['facilities']) && is_array($validated['facilities'])) {
            $validated['facilities'] = json_encode($validated['facilities']);
        }
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
        // Không còn trường is_active, nên chuyển trạng thái qua status
        $parkingLot->update([
            'status' => $parkingLot->status === 'active' ? 'inactive' : 'active'
        ]);
        $status = $parkingLot->status === 'active' ? 'kích hoạt' : 'vô hiệu hóa';
        return redirect()->route('admin.parking-lots.index')
                        ->with('success', "Đã {$status} bãi đỗ xe thành công!");
    }
}
