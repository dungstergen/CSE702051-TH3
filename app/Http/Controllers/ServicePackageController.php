<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicePackage;
use App\Models\ParkingLot;
use Illuminate\Support\Facades\Auth;

class ServicePackageController extends Controller
{
    /**
     * Display service packages listing
     */
    public function index()
    {
        $servicePackages = ServicePackage::active()
            ->orderBy('is_featured', 'desc')
            ->orderBy('price', 'asc')
            ->get();

        $featuredPackages = $servicePackages->where('is_featured', true);
        $regularPackages = $servicePackages->where('is_featured', false);

        return view('user.service-packages', compact('servicePackages', 'featuredPackages', 'regularPackages'));
    }

    /**
     * Show service package details
     */
    public function show($id)
    {
        $servicePackage = ServicePackage::active()->findOrFail($id);

        // Get parking lots that support this service package
        $supportingParkingLots = $servicePackage->parkingLots()
            ->where('status', 'active')
            ->get();

        // Get user's booking history with this package (if any)
        $userBookings = [];
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $userBookings = $user->bookings()
                ->where('service_package_id', $servicePackage->id)
                ->with('parkingLot')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        return view('user.service-package-details', compact('servicePackage', 'supportingParkingLots', 'userBookings'));
    }

    /**
     * Get service packages for AJAX (used in booking form)
     */
    public function getPackages(Request $request)
    {
        $parkingLotId = $request->query('parking_lot_id');

        $query = ServicePackage::active();

        if ($parkingLotId) {
            $query->whereHas('parkingLots', function($q) use ($parkingLotId) {
                $q->where('parking_lots.id', $parkingLotId);
            });
        }

        $packages = $query->orderBy('price', 'asc')->get();

        return response()->json($packages);
    }

    /**
     * Compare service packages
     */
    public function compare(Request $request)
    {
        $packageIds = $request->input('packages', []);

        if (count($packageIds) < 2 || count($packageIds) > 3) {
            return redirect()->route('user.service-packages')
                ->withErrors(['error' => 'Vui lòng chọn từ 2 đến 3 gói dịch vụ để so sánh']);
        }

        $servicePackages = ServicePackage::active()
            ->whereIn('id', $packageIds)
            ->get();

        if ($servicePackages->count() !== count($packageIds)) {
            return redirect()->route('user.service-packages')
                ->withErrors(['error' => 'Một hoặc nhiều gói dịch vụ không tồn tại']);
        }

        return view('user.service-packages-compare', compact('servicePackages'));
    }
}
