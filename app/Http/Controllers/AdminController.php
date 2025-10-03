<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin dashboard
     */
    public function dashboard()
    {
        // Statistics for dashboard
        $totalUsers = \App\Models\User::count();
        $totalParkingLots = \App\Models\ParkingLot::count();
        $totalBookings = \App\Models\Booking::count();
        $totalRevenue = \App\Models\Payment::where('payment_status', 'completed')->sum('amount');

        // Recent bookings with proper data handling
        $recentBookings = \App\Models\Booking::with(['user', 'parkingLot'])
                                ->orderBy('created_at', 'desc')
                                ->limit(10)
                                ->get() ?? collect();

        // Service packages and testimonials stats for new admin features
        $servicePackageStats = [
            'total' => 3,  // In real app, get from ServicePackage model
            'active' => 3,
            'featured' => 1,
        ];

        $testimonialStats = [
            'total' => 5,  // In real app, get from Testimonial model
            'published' => 3,
            'pending' => 1,
            'featured' => 2,
            'average_rating' => 4.6,
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalParkingLots',
            'totalBookings',
            'totalRevenue',
            'recentBookings',
            'servicePackageStats',
            'testimonialStats'
        ));
    }

    /**
     * Parking management
     */
    public function parking()
    {
        return view('admin.build.parking');
    }

    /**
     * Customer management
     */
    public function customers()
    {
        return view('admin.build.customers');
    }

    /**
     * Add new customer
     */
    public function addCustomer()
    {
        return view('admin.build.add-customer');
    }

    /**
     * VIP customer management
     */
    public function vipCustomer()
    {
        return view('admin.build.vip-customer');
    }

    /**
     * Reports page
     */
    public function reports()
    {
        return view('admin.build.reports');
    }

    /**
     * Revenue page
     */
    public function revenue()
    {
        return view('admin.build.revenue');
    }

    /**
     * User management
     */
    public function users()
    {
        return view('admin.build.users');
    }

    /**
     * Settings page
     */
    public function settings()
    {
        return view('admin.build.settings');
    }

    /**
     * Profile page
     */
    public function profile()
    {
        return view('admin.build.profile');
    }

    /**
     * Tables page
     */
    public function tables()
    {
        return view('admin.build.tables');
    }

    /**
     * About page
     */
    public function about()
    {
        return view('admin.build.about');
    }

    /**
     * Documentation page
     */
    public function documentation()
    {
        return view('admin.build.documentation');
    }

    /**
     * Sign in page
     */
    public function signIn()
    {
        return view('admin.build.sign-in');
    }

    /**
     * Sign up page
     */
    public function signUp()
    {
        return view('admin.build.sign-up');
    }

    /**
     * Logout functionality
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('admin.sign-in')->with('success', 'Đăng xuất thành công!');
    }
}
