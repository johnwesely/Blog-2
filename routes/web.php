<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FavoritesController;
use Illuminate\Support\Facades\Route;
use App\Services\Newsletter;

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

// Controller functions should be limited to 7 RESTful actions
// index: show all of a resource
// show: show one of a resource
// create: show a page to create a new item
// store: persist a submitted item in db
// edit: show a page to edit item
// update: persist edit to db
// destroy: destroy an item


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('post');

Route::get('comment/comments', [CommentController::class, 'index'])->middleware('admin');
Route::post('posts/{post:slug}/comments', [CommentController::class, 'store'])->middleware('auth');
Route::get('comment/{comment:id}/edit', [CommentController::class, 'edit'])->middleware('auth');
Route::patch('comment/{comment}', [CommentController::class, 'update'])->middleware('auth');

Route::post('newsletter', NewsletterController::class);  // no method passed, default to __invoke

Route::get('register', [RegistrationController::class, 'create'])->middleware('guest');
Route::post('register', [RegistrationController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');    // can only log in if guest
Route::post('sessions', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');  // can only log out if auth

Route::get('favorites', [FavoriteController::class, 'index'])->middleware('auth'); // !!! add functionality to show number of favorites in dash 
Route::post('favorites/{post}', [FavoriteController::class, 'store'])->middleware('auth'); 
Route::delete('favorites/{post}', [FavoriteController::class, 'destroy'])->middleware('auth');
Route::patch('favorites/{favorite}', [FavoriteController:: class, 'toggleRead'])->middleware('auth');

Route::middleware('can:admin')->group(function () {
    Route::get('admin/posts', [AdminPostController::class, 'index']);
    Route::get('admin/posts/create', [AdminPostController::class, 'create']);  
    Route::post('admin/posts', [AdminPostController::class, 'store']);
    Route::get('admin/posts/{post:slug}/edit', [AdminPostController::class, 'edit']); 
    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
    Route::patch('admin/posts/{post}/toggle-published', [AdminPostController::class, 'togglePublished']);
});
