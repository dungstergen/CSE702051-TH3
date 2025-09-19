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
