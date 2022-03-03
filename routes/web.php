<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Profile\UserProfileController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

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

Route::get('/', [PostController::class, 'index'])->name('home');
// Temporary for links in navbar
Route::get('category', function () {
    return "Category page";
})->name('category');
Route::get('about', function () {
    return "About page";
})->name('about');

require __DIR__.'/auth.php';
// Get post pages for other routes
Route::get('/{post}', [PostController::class, 'show'])->name('public.post.show');
