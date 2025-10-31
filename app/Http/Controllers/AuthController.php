<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        return view('auth.login');
    }

    // Hiển thị trang đăng ký
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        return view('auth.register');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Cập nhật thông tin đăng nhập gần nhất
            try {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                $user->last_login_at = now();
                $user->last_login_ip = $request->ip();
                $user->save();
            } catch (\Throwable $e) {
                // Bỏ qua nếu cột chưa tồn tại (trước khi migrate) hoặc lỗi không nghiêm trọng
            }

            return $this->redirectToDashboard()->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])
            ->withInput($request->except('password'));
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'user', // Giữ lại để tương thích
        ]);

        // Gán role mặc định cho user mới
        $user->assignRole('user');

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectToDashboard()->with('success', 'Đăng ký thành công!');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Đã đăng xuất!');
    }

    // Chuyển hướng theo role (dùng Spatie)
    protected function redirectToDashboard()
    {
    /** @var \App\Models\User $user */
    $user = Auth::user();

        // Kiểm tra bằng Spatie Permission
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
}
