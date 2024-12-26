<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::resource('orders', OrderController::class)->names('orders');
    Route::resource('services', ServiceController::class);
    Route::resource('users', UserController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
