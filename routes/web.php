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
