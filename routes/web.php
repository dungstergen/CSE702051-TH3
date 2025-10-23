<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;


// Public Home Page (Landing Page)
Route::get('/', function () {
    return view('user.index');
})->name('home');

// Login & Register routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Pages (Accessible without authentication)
Route::prefix('user')->name('user.')->group(function () {
    // Static Public Pages
    Route::get('/about', function () {
        return view('user.about');
    })->name('about');

    Route::get('/why', function () {
        return view('user.why');
    })->name('why');

    // Pricing & Services (Public)
    Route::get('/pricing', [App\Http\Controllers\UserController::class, 'pricing'])->name('pricing');
    Route::get('/testimonial', [App\Http\Controllers\UserController::class, 'testimonials'])->name('testimonial');

    // Service Packages (Public - View Only)
    Route::get('/service-packages', [App\Http\Controllers\ServicePackageController::class, 'index'])->name('service-packages');
    Route::get('/service-packages/{id}', [App\Http\Controllers\ServicePackageController::class, 'show'])->name('service-packages.show');
    Route::get('/service-packages/compare', [App\Http\Controllers\ServicePackageController::class, 'compare'])->name('service-packages.compare');
    Route::get('/api/service-packages', [App\Http\Controllers\ServicePackageController::class, 'getPackages'])->name('service-packages.api');

    // Booking - View parking lots (Public)
    Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking');

    // Parking Lot Detail (Public)
    Route::get('/parking-lot/{id}', [App\Http\Controllers\BookingController::class, 'showParkingLot'])->name('parking-lot.detail');

    // API endpoints for parking lots
    Route::get('/api/parking-lots', [App\Http\Controllers\BookingController::class, 'getParkingLots'])->name('api.parking-lots');
    Route::get('/api/parking-lot/{id}', [App\Http\Controllers\BookingController::class, 'getParkingLotDetails'])->name('api.parking-lot.details');
    Route::get('/api/parking-lot/{parkingLotId}/spots', [App\Http\Controllers\BookingController::class, 'getParkingSpots'])->name('api.parking-spots');
});

// Protected User Routes (Require Authentication + Role User)
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('password.update');
    Route::put('/profile/vehicles', [App\Http\Controllers\UserController::class, 'updateVehicles'])->name('vehicles.update');
    Route::delete('/account', [App\Http\Controllers\UserController::class, 'deleteAccount'])->name('account.delete');

    // API: Lấy danh sách xe của user hiện tại
    Route::get('/api/vehicles', [App\Http\Controllers\UserController::class, 'getVehicles'])->name('api.vehicles');

    // Booking System (Requires Auth)
    Route::post('/booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}', [App\Http\Controllers\BookingController::class, 'show'])->name('booking.show');
    Route::patch('/booking/{booking}/cancel', [App\Http\Controllers\BookingController::class, 'cancel'])->name('booking.cancel');

    // History
    Route::get('/history', [App\Http\Controllers\BookingController::class, 'history'])->name('history');

    // API endpoints for history
    Route::get('/api/bookings', [App\Http\Controllers\BookingController::class, 'getUserBookings'])->name('api.bookings');
    Route::get('/api/booking/{id}', [App\Http\Controllers\BookingController::class, 'getBookingDetail'])->name('api.booking.detail');

    // Payment System
    Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'show'])->name('payment');
    Route::post('/payment/process', [App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/success/{payment}', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/pending/{payment}', [App\Http\Controllers\PaymentController::class, 'pending'])->name('payment.pending');
    Route::get('/payment/cash/{payment}', [App\Http\Controllers\PaymentController::class, 'cash'])->name('payment.cash');
    Route::patch('/payment/{payment}/cancel', [App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.cancel');

    // API endpoints for payment
    Route::get('/api/payments', [App\Http\Controllers\PaymentController::class, 'getUserPayments'])->name('api.payments');

    // Reviews (User's own reviews - requires auth)
    Route::get('/reviews', [App\Http\Controllers\ReviewController::class, 'index'])->name('reviews');
    Route::get('/reviews/create', [App\Http\Controllers\ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{id}', [App\Http\Controllers\ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{id}/edit', [App\Http\Controllers\ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // API endpoints for reviews
    Route::get('/api/reviews', [App\Http\Controllers\ReviewController::class, 'getUserReviews'])->name('api.reviews');
    Route::get('/api/pending-reviews', [App\Http\Controllers\ReviewController::class, 'getPendingReviews'])->name('api.pending-reviews');
});

// Redirect helpers for backward compatibility
Route::redirect('/dashboard', '/user/dashboard')->middleware('auth');
Route::redirect('/booking', '/user/booking');
Route::redirect('/history', '/user/history')->middleware('auth');
Route::redirect('/payment', '/user/payment')->middleware('auth');


// Admin Routes (Require Authentication + Role Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
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
