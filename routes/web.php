<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Frontend.index');
});

Route::get('/about', function () {
    return view('Frontend.about');
});

Route::get('/pricing', function () {
    return view('Frontend.pricing');
});

Route::get('/why', function () {
    return view('Frontend.why');
});

Route::get('/testimonial', function () {
    return view('Frontend.testimonial');
});
