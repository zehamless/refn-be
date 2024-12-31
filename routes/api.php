<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::get('/check', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    Route::middleware('auth')->group(function () {
        Route::resource('orders', OrderController::class)->names('orders');
        Route::resource('services', ServiceController::class);
        Route::resource('users', UserController::class);
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard/recent-orders', [DashboardController::class, 'getRecentOrder'])->name('dashboard.recent-orders');
        Route::get('dashboard/processing-orders', [DashboardController::class, 'getProcessingOrder'])->name('dashboard.processing-orders');
    });
    require __DIR__ . '/auth.php';
});
