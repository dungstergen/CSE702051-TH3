<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\ParkingLot;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Show user dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();

        // User statistics
        $userStats = [
            'total_bookings' => Booking::where('user_id', $user->id)->count(),
            'active_bookings' => Booking::where('user_id', $user->id)
                                      ->whereIn('status', ['confirmed', 'checked_in'])
                                      ->count(),
            'completed_bookings' => Booking::where('user_id', $user->id)
                                          ->where('status', 'completed')
                                          ->count(),
            'total_spent' => Payment::where('user_id', $user->id)
                                   ->where('payment_status', 'completed')
                                   ->sum('amount'),
            'total_hours' => Booking::where('user_id', $user->id)
                                   ->where('status', 'completed')
                                   ->sum('duration_hours'),
        ];

        // Recent bookings
        $recentBookings = Booking::with(['parkingLot', 'payment'])
                                ->where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();

        // Upcoming bookings
        $upcomingBookings = Booking::with(['parkingLot'])
                                  ->where('user_id', $user->id)
                                  ->where('start_time', '>', now())
                                  ->whereIn('status', ['confirmed', 'pending'])
                                  ->orderBy('start_time', 'asc')
                                  ->limit(3)
                                  ->get();

        // User's favorite parking lots (most booked)
        $favoriteParkingLots = DB::table('bookings')
                                ->select('parking_lot_id', DB::raw('count(*) as booking_count'))
                                ->where('user_id', $user->id)
                                ->groupBy('parking_lot_id')
                                ->orderBy('booking_count', 'desc')
                                ->limit(3)
                                ->get();

        // Lấy tất cả parking lots
        $favoriteLots = ParkingLot::inRandomOrder()
                                   ->limit(6)
                                   ->get()
                                   ->map(function($lot) {
                                       // Tính rating trung bình thủ công
                                       $avgRating = $lot->reviews()
                                                        ->where('status', 'active')
                                                        ->avg('rating');
                                       $lot->average_rating = $avgRating ?? 0;
                                       return $lot;
                                   });

        return view('user.dashboard', compact(
            'user',
            'userStats',
            'recentBookings',
            'upcomingBookings',
            'favoriteLots'
        ));
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();

        // Ensure profile fields exist (set defaults if null)
        $user->address = $user->address ?? '';
        $user->date_of_birth = $user->date_of_birth ?? null;
        $user->gender = $user->gender ?? '';

        // Load user's vehicles
        $vehicles = $user->vehicles;

        return view('user.profile', compact('user', 'vehicles'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
            'phone.max' => 'Số điện thoại không được quá 20 ký tự.',
            'address.max' => 'Địa chỉ không được quá 500 ký tự.',
            'date_of_birth.date' => 'Ngày sinh không đúng định dạng.',
            'gender.in' => 'Giới tính không hợp lệ.',
        ]);

        $user = User::find(Auth::id());

        // Update only basic fields that exist in database for now
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Add profile fields if they exist in database
        try {
            $user->update($updateData);
        } catch (\Exception $e) {
            // If update fails, just update basic fields
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
        }

        return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin thành công!');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.profile')->with('success', 'Đổi mật khẩu thành công!');
    }

    /**
     * Delete user account
     */
    public function deleteAccount()
    {
        /** @var User $user */
        $user = Auth::user();

        // Check if user has pending bookings
        $pendingBookings = Booking::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('start_time', '>', now())
            ->count();

        if ($pendingBookings > 0) {
            return back()->withErrors(['error' => 'Không thể xóa tài khoản khi còn đặt chỗ đang chờ xử lý']);
        }

        // Cancel all unpaid bookings
        Booking::where('user_id', $user->id)
            ->where('payment_status', '!=', 'completed')
            ->update(['status' => 'cancelled', 'payment_status' => 'cancelled']);

        // Get user ID before deletion
        $userId = $user->id;

        // Log out user
        Auth::logout();

        // Delete user account
        User::destroy($userId);

        return redirect()->route('login')->with('success', 'Tài khoản đã được xóa thành công');
    }

    /**
     * Show booking history
     */
    public function history(Request $request)
    {
        $user = Auth::user();

        $query = Booking::with(['parkingLot', 'payment'])
                       ->where('user_id', $user->id);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('from_date') && $request->from_date != '') {
            $query->whereDate('booking_date', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $query->whereDate('booking_date', '<=', $request->to_date);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);

        // Booking statistics
        $stats = [
            'total' => Booking::where('user_id', $user->id)->count(),
            'completed' => Booking::where('user_id', $user->id)->where('status', 'completed')->count(),
            'cancelled' => Booking::where('user_id', $user->id)->where('status', 'cancelled')->count(),
            'pending' => Booking::where('user_id', $user->id)->where('status', 'pending')->count(),
        ];

        return view('user.history', compact('bookings', 'stats'));
    }

    /**
     * Show available parking lots for booking
     */
    public function booking()
    {
        // Get active parking lots with availability
        $parkingLots = ParkingLot::where('is_active', true)
                                ->where('available_spots', '>', 0)
                                ->orderBy('is_featured', 'desc')
                                ->orderBy('average_rating', 'desc')
                                ->get();

        // Get user's recent booking locations for quick access
        $recentLocations = Booking::with('parkingLot')
                                 ->where('user_id', Auth::id())
                                 ->orderBy('created_at', 'desc')
                                 ->limit(3)
                                 ->pluck('parking_lot_id')
                                 ->unique();

        $recentParkingLots = ParkingLot::whereIn('id', $recentLocations)
                                     ->where('is_active', true)
                                     ->get();

        return view('user.booking', compact('parkingLots', 'recentParkingLots'));
    }

    /**
     * Show pricing and service packages
     */
    public function pricing()
    {
        // Get service packages (assuming we have this table from admin)
        $servicePackages = DB::table('service_packages')
                           ->where('is_active', true)
                           ->orderBy('is_featured', 'desc')
                           ->orderBy('price', 'asc')
                           ->get();

        return view('user.pricing', compact('servicePackages'));
    }

    /**
     * Show testimonials
     */
    public function testimonials()
    {
        // Get published testimonials
        $testimonials = DB::table('testimonials')
                        ->where('status', 'published')
                        ->orderBy('is_featured', 'desc')
                        ->orderBy('display_order', 'asc')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('user.testimonial', compact('testimonials'));
    }

    /**
     * Update user vehicles
     */

    public function updateVehicles(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'vehicles' => 'nullable|array',
            'vehicles.*.number' => 'required|string|max:20',
            'vehicles.*.type' => 'required|in:car,motorbike,truck,other',
            'vehicles.*.brand' => 'nullable|string|max:50',
        ], [
            'vehicles.*.number.required' => 'Vui lòng nhập biển số xe',
            'vehicles.*.number.max' => 'Biển số xe không được quá 20 ký tự',
            'vehicles.*.type.required' => 'Vui lòng chọn loại xe',
            'vehicles.*.type.in' => 'Loại xe không hợp lệ',
            'vehicles.*.brand.max' => 'Nhãn hiệu không được quá 50 ký tự',
        ]);

        $inputVehicles = $request->vehicles ?? [];
        $inputIds = collect($inputVehicles)->pluck('id')->filter()->all();

        // Xóa các xe không còn trong danh sách
        $user->vehicles()->whereNotIn('id', $inputIds)->delete();

        foreach ($inputVehicles as $index => $vehicleData) {
            if (empty($vehicleData['number'])) {
                continue;
            }
            $data = [
                'license_plate' => strtoupper(trim($vehicleData['number'])),
                'vehicle_type' => $vehicleData['type'],
                'brand' => !empty($vehicleData['brand']) ? trim($vehicleData['brand']) : null,
                'is_default' => $index === 0,
            ];
            if (!empty($vehicleData['id'])) {
                // Cập nhật xe cũ
                $user->vehicles()->where('id', $vehicleData['id'])->update($data);
            } else {
                // Thêm xe mới
                $user->vehicles()->create($data);
            }
        }

        return redirect()->route('user.profile', ['tab' => 'vehicle'])->with('success', 'Cập nhật thông tin xe thành công!');
    }
    public function getVehicles(Request $request)
    {
        $user = Auth::user();
        $vehicles = $user->vehicles()->get()->map(function($v) {
            return [
                'id' => $v->id,
                'number' => $v->license_plate,
                'type' => $v->vehicle_type,
                'brand' => $v->brand,
            ];
        });
        return response()->json([
            'success' => true,
            'vehicles' => $vehicles
        ]);
    }


}
