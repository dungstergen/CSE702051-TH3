<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index');
});

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/pricing', function () {
    return view('user.pricing');
});

Route::get('/why', function () {
    return view('user.why');
});

Route::get('/testimonial', function () {
    return view('user.testimonial');
});

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::get('/register', function () {
    return view('user.register');
})->name('register');

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

//Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Redirect root admin to dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Main admin pages
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/parking', [App\Http\Controllers\AdminController::class, 'parking'])->name('parking');

    // Customer management
    Route::get('/customers', [App\Http\Controllers\AdminController::class, 'customers'])->name('customers');
    Route::get('/customers/add', [App\Http\Controllers\AdminController::class, 'addCustomer'])->name('customers.add');
    Route::get('/customers/vip', [App\Http\Controllers\AdminController::class, 'vipCustomer'])->name('customers.vip');

    // Reports and analytics
    Route::get('/reports', [App\Http\Controllers\AdminController::class, 'reports'])->name('reports');
    Route::get('/revenue', [App\Http\Controllers\AdminController::class, 'revenue'])->name('revenue');

    // System management
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('settings');

    // Additional pages
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('profile');
    Route::get('/tables', [App\Http\Controllers\AdminController::class, 'tables'])->name('tables');
    Route::get('/about', [App\Http\Controllers\AdminController::class, 'about'])->name('about');
    Route::get('/documentation', [App\Http\Controllers\AdminController::class, 'documentation'])->name('documentation');

    // Authentication routes
    Route::get('/sign-in', [App\Http\Controllers\AdminController::class, 'signIn'])->name('sign-in');
    Route::get('/sign-up', [App\Http\Controllers\AdminController::class, 'signUp'])->name('sign-up');

    // Logout routes (both GET and POST)
    Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout.get');
});
