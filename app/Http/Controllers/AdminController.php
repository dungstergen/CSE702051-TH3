<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // Month-over-month growth metrics
        $now = now();
        $curStart = $now->copy()->startOfMonth();
        $curEnd = $now->copy()->endOfMonth();
        $prevStart = $curStart->copy()->subMonth()->startOfMonth();
        $prevEnd = $curStart->copy()->subMonth()->endOfMonth();

        // Revenue MoM (completed payments)
        $curRevenue = \App\Models\Payment::where('payment_status', 'completed')
            ->whereBetween(DB::raw('DATE(COALESCE(paid_at, created_at))'), [$curStart->toDateString(), $curEnd->toDateString()])
            ->sum('amount');
        $prevRevenue = \App\Models\Payment::where('payment_status', 'completed')
            ->whereBetween(DB::raw('DATE(COALESCE(paid_at, created_at))'), [$prevStart->toDateString(), $prevEnd->toDateString()])
            ->sum('amount');
        $revenueMoMPct = $prevRevenue > 0 ? round((($curRevenue - $prevRevenue) * 100) / $prevRevenue, 1) : ($curRevenue > 0 ? 100.0 : 0.0);

        // Users MoM (new users created)
        $curUsers = \App\Models\User::whereBetween('created_at', [$curStart, $curEnd])->count();
        $prevUsers = \App\Models\User::whereBetween('created_at', [$prevStart, $prevEnd])->count();
        $usersMoMPct = $prevUsers > 0 ? round((($curUsers - $prevUsers) * 100) / $prevUsers, 1) : ($curUsers > 0 ? 100.0 : 0.0);

        // Bookings MoM (bookings created)
        $curBookings = \App\Models\Booking::whereBetween('created_at', [$curStart, $curEnd])->count();
        $prevBookings = \App\Models\Booking::whereBetween('created_at', [$prevStart, $prevEnd])->count();
        $bookingsMoMPct = $prevBookings > 0 ? round((($curBookings - $prevBookings) * 100) / $prevBookings, 1) : ($curBookings > 0 ? 100.0 : 0.0);

        // New parking lots this month
        $newParkingLotsCount = \App\Models\ParkingLot::whereBetween('created_at', [$curStart, $curEnd])->count();

        // Recent bookings with proper data handling
        $recentBookings = \App\Models\Booking::with(['user', 'parkingLot'])
                                ->orderBy('created_at', 'desc')
                                ->limit(10)
                                ->get() ?? collect();

        // Top service packages (last 30 days by revenue)
        $spStart = now()->copy()->subDays(29)->startOfDay();
        $spEnd = now()->copy()->endOfDay();
        $topPackagesRaw = \App\Models\Payment::query()
            ->where('payments.payment_status', 'completed')
            ->whereBetween(DB::raw('DATE(COALESCE(payments.paid_at, payments.created_at))'), [$spStart->toDateString(), $spEnd->toDateString()])
            ->join('bookings', 'bookings.id', '=', 'payments.booking_id')
            ->join('service_packages', 'service_packages.id', '=', 'bookings.service_package_id')
            ->select('service_packages.id', 'service_packages.name', 'service_packages.price', DB::raw('SUM(payments.amount) as revenue'), DB::raw('COUNT(bookings.id) as usage_count'))
            ->groupBy('service_packages.id', 'service_packages.name', 'service_packages.price')
            ->orderByDesc('revenue')
            ->get();

        $totalRevenuePackages = (float) ($topPackagesRaw->sum('revenue') ?? 0);
        $topPackages = $topPackagesRaw->take(3)->map(function ($row) use ($totalRevenuePackages) {
            $pct = $totalRevenuePackages > 0 ? round(((float) $row->revenue * 100) / $totalRevenuePackages, 1) : 0.0;
            return [
                'name' => $row->name,
                'price' => number_format((float) $row->price, 0, ',', '.') . 'đ',
                'usage' => (int) $row->usage_count,
                'percentage' => $pct,
            ];
        });

        // Placeholder testimonial stats (no testimonial module wired yet)
        $testimonialStats = [
            'total' => 0,
            'published' => 0,
            'pending' => 0,
            'featured' => 0,
            'average_rating' => null,
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalParkingLots',
            'totalBookings',
            'totalRevenue',
            'recentBookings',
            'testimonialStats',
            'revenueMoMPct',
            'usersMoMPct',
            'bookingsMoMPct',
            'newParkingLotsCount',
            'topPackages'
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
