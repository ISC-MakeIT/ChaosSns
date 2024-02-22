<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::prefix('/users')->group(function() {
    Route::post('/', [UserController::class, 'create'])->name('users.registration');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
});

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('/users')->group(function() {
        Route::get('/self', [UserController::class, 'getLoggedInUser'])->name('users.self');
        Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    });
});

Route::prefix('/users')->group(function() {
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
});
