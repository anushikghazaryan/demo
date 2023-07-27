<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('index');
Route::get('/users/{id}/details', [App\Http\Controllers\UserController::class, 'details'])->name('details');
Route::post('/users/{id}/details', [App\Http\Controllers\UserController::class, 'updateLikes'])->name('update_likes');
Route::get('/users/{id}/chat', [App\Http\Controllers\UserController::class, 'getMessages'])->name('get_messages');
Route::post('/users/{id}/chat', [App\Http\Controllers\UserController::class, 'sendMessage'])->name('send_messages');
Route::get('/users/my-page', [App\Http\Controllers\UserController::class, 'myPage'])->name('my_page');
Route::post('/users/my-page', [App\Http\Controllers\UserController::class, 'createPost'])->name('create_post');

Route::fallback(function () {
    return redirect()->route('index');
});
