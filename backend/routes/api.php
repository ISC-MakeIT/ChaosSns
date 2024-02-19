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
    Route::get('/self', [UserController::class, 'getLoggedInUser'])->name('users.self');
    Route::post('/', [UserController::class, 'create'])->name('users.registration');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
