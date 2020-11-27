<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'show'])->name('show');
Route::get('/profile/{user}/editprofile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('store');

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('create');
Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('store');
Route::post('/post/{postid}/delete', [App\Http\Controllers\PostController::class, 'destroy'])->name('destroy');

Route::get('/addfriend/{user}', [App\Http\Controllers\FriendController::class, 'store'])->name('store');
Route::get('/removefriend/{user}', [App\Http\Controllers\FriendController::class, 'destroy'])->name('destroy');

Route::post('/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('store');
Route::post('/deletecomment', [App\Http\Controllers\CommentController::class, 'destroy'])->name('destroy');

Route::post('/react', [App\Http\Controllers\ReactController::class, 'store'])->name('store');

Route::get('/friends', [App\Http\Controllers\FriendController::class, 'show'])->name('show');
Route::get('/friends/myfriends', [App\Http\Controllers\FriendController::class, 'myfriends'])->name('myfriends');
Route::get('/friends/received', [App\Http\Controllers\FriendController::class, 'received'])->name('received');
Route::get('/friends/sent', [App\Http\Controllers\FriendController::class, 'sent'])->name('sent');
Route::get('/friends/others', [App\Http\Controllers\FriendController::class, 'others'])->name('others');