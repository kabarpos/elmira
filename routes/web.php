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

Route::middleware(['auth', 'verified'])->group(function () {
    // User dashboard route
    Route::get('/dashboard', function () {
        return Inertia::render('User/Dashboard');
    })->name('user.dashboard')->middleware('role:user');

    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['web', 'role:super-admin|admin'])
        ->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            
            // Users Management (Only for super-admin)
            Route::middleware(['role:super-admin'])->group(function () {
                Route::resource('users', UserController::class);
                Route::resource('roles', RoleController::class);
            });
            
            // Content Management (For both admin and super-admin)
            Route::middleware(['permission:manage content'])->group(function () {
                Route::resource('posts', PostController::class);
                Route::resource('categories', CategoryController::class);
            });
            
            // Media Management
            Route::middleware(['permission:manage media'])->group(function () {
                Route::resource('media', MediaController::class);
            });
        });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
