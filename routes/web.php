<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// regiter
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// home
Route::get('/home' , [AuthController::class, 'index']);