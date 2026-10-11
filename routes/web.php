<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiskRegisterController;
use Illuminate\Support\Facades\Route;

// Public landing page
Route::get('/', function () {
    return view('welcome');
});

// Protected e-RMS routes
Route::middleware(['auth', 'verified', 'access'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Risk Register - Admin and LPU (read-only)
    Route::get('/risks', [RiskRegisterController::class, 'index'])
        ->name('risks.index');

    // Temporary role access test routes
    Route::get('/admin', function () {
        return 'Admin access granted.';
    })->middleware('access:admin')->name('admin.home');

    Route::get('/lpu', function () {
        return 'LPU access granted.';
    })->middleware('access:lpu')->name('lpu.home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
