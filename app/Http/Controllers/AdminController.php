<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check current password if changing password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.'])->withInput();
            }
        }

        // Update basic info
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if ($request->filled('phone')) {
            $admin->phone = $validated['phone'];
        }

        // Update password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($validated['password']);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($admin->avatar && Storage::exists('public/' . $admin->avatar)) {
                Storage::delete('public/' . $admin->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $admin->avatar = $avatarPath;
        }

        $admin->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
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
