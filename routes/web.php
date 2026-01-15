<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// for admin
// for custom middleware user
Route::get('/admin/dashboard', function () {
    return 'Admin Dashboard';
})->middleware('rolecheck')->name('admin.dashboard');

// incase we have different user table for admin then we can use default middleware by customizing it littlebit
// otherwise we can use custom middleware
// for default middleware use for admin
Route::middleware('auth:admin')->get('/admin/dashboard', function () {
    return 'vwlodns';
});

// for common user

Route::middleware('auth')->get('/user', function () {
    // sadsadsad
});
