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

//Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.build.dashboard');
    })->name('dashboard');

    Route::get('/parking', function () {
        return view('admin.build.parking');
    })->name('parking');

    Route::get('/customers', function () {
        return view('admin.build.customers');
    })->name('customers');

    Route::get('/reports', function () {
        return view('admin.build.reports');
    })->name('reports');

    Route::get('/revenue', function () {
        return view('admin.build.revenue');
    })->name('revenue');

    Route::get('/users', function () {
        return view('admin.build.users');
    })->name('users');

    Route::get('/settings', function () {
        return view('admin.build.settings');
    })->name('settings');

    Route::get('/documentation', function () {
        return view('admin.build.documentation');
    })->name('documentation');

    Route::get('/profile', function () {
        return view('admin.build.profile');
    })->name('profile');

    Route::get('/tables', function () {
        return view('admin.build.tables');
    })->name('tables');

    Route::get('/about', function () {
        return view('admin.about');
    })->name('about');

    // Authentication routes
    Route::get('/sign-in', function () {
        return view('admin.build.sign-in');
    })->name('sign-in');

    Route::get('/sign-up', function () {
        return view('admin.build.sign-up');
    })->name('sign-up');

    Route::post('/logout', function () {
        // Logout logic here
        session()->flush();
        return redirect()->route('admin.sign-in')->with('success', 'Đăng xuất thành công!');
    })->name('logout');

    Route::get('/logout', function () {
        // GET logout for direct access
        session()->flush();
        return redirect()->route('admin.sign-in')->with('success', 'Đăng xuất thành công!');
    })->name('logout.get');
});
