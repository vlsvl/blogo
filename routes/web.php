<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\Profile\UserProfileController;
use App\Http\Controllers\Public\CommentController;
use App\Http\Controllers\Public\SubscribeController;
use App\Http\Controllers\SendMessageController;
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
//     Storage::cloud()->put('hello.json', '{"hello": "world"}');
    \App\Events\Hello::dispatch('Test public message from category route');
    dump(Storage::cloud()->files());
    return "Category page";
})->name('category');
Route::get('about', function () {
    return "About page";
})->name('about');
Route::post('/comment', [CommentController::class, 'store'])->name('public.comment.store');
Route::get('/test', function () {
    Inertia::render('Public/Test');
});
Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/chat/{room?}', ChatRoomController::class)->name('chat');
    Route::post('/message', SendMessageController::class)->name('send.message');
});

require __DIR__.'/auth.php';
// Get post pages for other routes
Route::get('/{post}', [PostController::class, 'show'])->name('public.post.show');
