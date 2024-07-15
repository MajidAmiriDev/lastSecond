<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BookingController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('activities', [ActivityController::class, 'store']);
Route::put('activities/{id}', [ActivityController::class, 'update']);
Route::delete('activities/{id}', [ActivityController::class, 'destroy']);

// Booking routes
Route::post('bookings', [BookingController::class, 'store']);
Route::get('activities', [ActivityController::class, 'index']);
Route::get('activities/{id}', [ActivityController::class, 'show']);
Route::get('activities/search', [ActivityController::class, 'search']);
Route::middleware(['booking.owner'])->post('bookings/{id}/cancel', [BookingController::class, 'cancel']);