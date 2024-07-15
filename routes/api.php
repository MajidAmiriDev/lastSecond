<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BookingController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('activities', ActivityController::class);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('activities/search', [ActivityController::class, 'search']);