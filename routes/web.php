<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'], function () {
    Route::get('/login', function () {
        return view('pages.auth.login');
    });
});



Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.dashboard',  ['type_menu' => 'dashboard']);
    })->name('home');

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});
