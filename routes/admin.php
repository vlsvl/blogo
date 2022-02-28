<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Profile\UserProfileController;

Route::get('/admin', function () {
    return redirect(route('dashboard'), 301);
});

Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth', 'verified']
    ], function () {
        // Dashboard
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
        // Profile
        Route::get('profile/{user}', [UserProfileController::class, 'index'])->name('profile');
        Route::post('profile/update-info', [UserProfileController::class, 'updateCurrentUserInfo'])->name('profile.updateCurrentInfo');
        Route::post('profile/update-password', [UserProfileController::class, 'updateCurrentUserPassword'])->name('profile.updateCurrentPassword');
        Route::post('profile/delete-profile', [UserProfileController::class, 'deleteCurrentUserProfile'])->name('profile.deleteCurrentProfile');
        // Users
        Route::resource('users', UserController::class);
        // Roles
        Route::resource('roles', RoleController::class);
});
