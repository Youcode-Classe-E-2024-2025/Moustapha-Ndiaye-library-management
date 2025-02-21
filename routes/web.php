<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//  publics Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//  admin route
Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function() {
    Route::get('/admin', [AuthController::class, 'adminDashboard'])->name('admin');
});
// Route::middleware(['auth', 'admin'])->group(function() {
//     Route::get('/admin', [AuthController::class, 'adminDashboard'])->name('admin');
// });

// Routes utilisateur
Route::middleware(['auth'])->group(function() {
    Route::get('/user', [AuthController::class, 'userDashboard'])->name('user');
});

