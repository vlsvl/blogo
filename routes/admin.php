<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return redirect(route('dashboard'), 301);
});

Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth', 'verified']
    ], function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
        Route::get('profile/{user}', function () {
            return Inertia::render('Profile/Index');
        })->name('profile');
        Route::resource('users', UserController::class);
});
