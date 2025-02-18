<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// regiter formular
Route::get('/', [AuthController::class, 'showRegisterForm'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');