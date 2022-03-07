<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Profile\UserProfileController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, array_keys(config('blogo.locales')))) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale');

Route::get('/', function () {
    return redirect(route('dashboard'), 301);
});

Route::group([
        'middleware' => ['auth', 'verified']
    ], function () {
        // Dashboard
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        // Profile
        Route::get('profile/{user}', [UserProfileController::class, 'index'])
            ->name('profile');
        Route::post('profile/update-info', [UserProfileController::class, 'updateCurrentUserInfo'])
            ->name('profile.updateCurrentInfo');
        Route::post('profile/update-password', [UserProfileController::class, 'updateCurrentUserPassword'])
            ->name('profile.updateCurrentPassword');
        Route::post('profile/delete-profile', [UserProfileController::class, 'deleteCurrentUserProfile'])
            ->name('profile.deleteCurrentProfile');
        // Users
        Route::resource('users', UserController::class)
            ->only(['index', 'show', 'destroy']);
        Route::get('users/auth-as/{user}', [UserController::class, 'authAs'])
            ->name('users.auth_as');
        Route::patch('users/change-role/{user}', [UserController::class, 'changeRole'])
            ->name('users.change_role');
        // Roles
        Route::resource('roles', RoleController::class);
        // Posts
        Route::resource('posts', PostController::class);
        // Comments
        Route::resource('comments', CommentController::class);
});
