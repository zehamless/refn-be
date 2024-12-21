<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('services', ServiceController::class);
});
