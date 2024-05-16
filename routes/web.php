<?php

use App\Http\Controllers\AuthController;
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

    Route::resource('/users', UserController::class);
});
