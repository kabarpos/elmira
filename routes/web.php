<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Regular user routes
Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('User/Dashboard');
    })->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::class . ':view dashboard')->name('user.dashboard');
});

// Admin routes
Route::middleware(['web', 'auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->middleware(\Spatie\Permission\Middleware\PermissionMiddleware::class . ':manage users')
        ->name('admin.dashboard');
});

// Profile routes
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
