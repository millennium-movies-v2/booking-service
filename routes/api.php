<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\MovieScreeningController;
use Illuminate\Support\Facades\Route;

Route::apiResource('bookings', BookingController::class)
->only('store');

Route::apiResource('movies.screenings', MovieScreeningController::class)
    ->only(['index']);
