<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;


// Redirect trang chủ đến login
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if (in_array($user->role, ['admin', 'super_admin'])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});

// Login & Register routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');

    // Booking System
    Route::get('/booking', [App\Http\Controllers\UserController::class, 'booking'])->name('booking');
    Route::get('/history', [App\Http\Controllers\UserController::class, 'history'])->name('history');

    // Pricing & Services
    Route::get('/pricing', [App\Http\Controllers\UserController::class, 'pricing'])->name('pricing');
    Route::get('/testimonial', [App\Http\Controllers\UserController::class, 'testimonials'])->name('testimonial');

    // Static pages
    Route::get('/about', function () {
        return view('user.about');
    })->name('about');

    Route::get('/why', function () {
        return view('user.why');
    })->name('why');

    Route::get('/payment', function () {
        return view('user.payment');
    })->name('payment');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/booking', function () {
    return view('user.booking');
});

Route::get('/history', function () {
    return view('user.history');
});

Route::get('/payment', function () {
    return view('user.payment');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Redirect root admin to dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::resource('users', App\Http\Controllers\AdminUserController::class);
    Route::patch('/users/{user}/toggle-status', [App\Http\Controllers\AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Parking Lot Management
    Route::resource('parking-lots', App\Http\Controllers\AdminParkingLotController::class);
    Route::patch('/parking-lots/{parkingLot}/toggle-status', [App\Http\Controllers\AdminParkingLotController::class, 'toggleStatus'])->name('parking-lots.toggle-status');

    // Booking Management
    Route::resource('bookings', App\Http\Controllers\AdminBookingController::class);
    Route::patch('/bookings/{booking}/update-status', [App\Http\Controllers\AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');

    // Payment Management
    Route::resource('payments', App\Http\Controllers\AdminPaymentController::class);
    Route::patch('/payments/{payment}/update-status', [App\Http\Controllers\AdminPaymentController::class, 'updateStatus'])->name('payments.update-status');

    // Review Management
    Route::resource('reviews', App\Http\Controllers\AdminReviewController::class);
    Route::patch('/reviews/{review}/toggle-visibility', [App\Http\Controllers\AdminReviewController::class, 'toggleVisibility'])->name('reviews.toggle-visibility');

    // Service Package Management
    Route::resource('service-packages', App\Http\Controllers\Admin\AdminServicePackageController::class);
    Route::patch('/service-packages/{servicePackage}/toggle-status', [App\Http\Controllers\Admin\AdminServicePackageController::class, 'toggleStatus'])->name('service-packages.toggle-status');
    Route::patch('/service-packages/{servicePackage}/toggle-featured', [App\Http\Controllers\Admin\AdminServicePackageController::class, 'toggleFeatured'])->name('service-packages.toggle-featured');

    // Testimonial Management
    Route::resource('testimonials', App\Http\Controllers\Admin\AdminTestimonialController::class);
    Route::patch('/testimonials/{testimonial}/update-status', [App\Http\Controllers\Admin\AdminTestimonialController::class, 'updateStatus'])->name('testimonials.update-status');
    Route::patch('/testimonials/{testimonial}/toggle-featured', [App\Http\Controllers\Admin\AdminTestimonialController::class, 'toggleFeatured'])->name('testimonials.toggle-featured');
    Route::post('/testimonials/bulk-action', [App\Http\Controllers\Admin\AdminTestimonialController::class, 'bulkAction'])->name('testimonials.bulk-action');

    // Reports
    Route::get('/reports', [App\Http\Controllers\AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/revenue', [App\Http\Controllers\AdminReportController::class, 'revenue'])->name('reports.revenue');
    Route::get('/reports/usage', [App\Http\Controllers\AdminReportController::class, 'usage'])->name('reports.usage');
    Route::get('/reports/export/{type}', [App\Http\Controllers\AdminReportController::class, 'export'])->name('reports.export');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\AdminController::class, 'updateProfile'])->name('profile.update');
});
