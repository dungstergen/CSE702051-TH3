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
        return view('admin.build.dashboard');
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
