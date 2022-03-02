<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Public\PostController;

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
require __DIR__.'/admin.php';

// Get post pages for other routes
Route::get('/{post}', [PostController::class, 'show'])->name('public.post.show');
