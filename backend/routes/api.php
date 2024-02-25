<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TweetActionController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::get('/self', [UserController::class, 'getLoggedInUser'])->name('users.self');
        Route::put('/', [UserController::class, 'update'])->name('users.update');
        Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
        Route::post('/follow/{id}', [UserController::class, 'follow'])->name('users.follow');
    });
    Route::prefix('/tweets')->group(function () {
        Route::post('/', [TweetController::class, 'create']);
        Route::post('/action/{tweet}', [TweetActionController::class, 'toggleActionTweet']);
        Route::delete('/{id}', [TweetController::class, 'deleteTweet']);
    });
});

Route::prefix('/tweets')->group(function () {
    Route::get('/', [TweetController::class, 'getTweets'])->name('tweets');
});

Route::prefix('/notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'getNotifications']);
    Route::get('/not_read_count', [NotificationController::class, 'getNotReadNotificationsCount']);
    Route::post('/read_all', [NotificationController::class, 'readAllNotifications']);
});

Route::prefix('/users')->group(function () {
    Route::post('/', [UserController::class, 'create'])->name('users.registration');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    Route::put('/icon/{id}', [UserController::class, 'editUserIcon'])->name('users.editUserIcon');
    Route::get('/{id}', [UserController::class, 'find'])->name('users.find');
});
