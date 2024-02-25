<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/users')->group(function () {
    Route::post('/', [UserController::class, 'create'])->name('users.registration');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    Route::get('/{id}', [UserController::class, 'find'])->name('users.find');
    Route::put('/{id}/icon', [UserController::class, 'EditUserIcon'])->name('users.EditUserIcon');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::get('/self', [UserController::class, 'getLoggedInUser'])->name('users.self');
        Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    });
});

Route::prefix('/tweets')->group(function () {
    Route::get('/', [TweetController::class, 'getTweets']);
});

Route::prefix('/notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'getNotifications']);
});
