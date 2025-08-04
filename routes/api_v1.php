<?php

use App\Http\Controllers\Api\V1\JobOpeningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/***Jobs Routes */
Route::apiResource('jobs', JobOpeningController::class)->except('store');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('jobs', [JobOpeningController::class, 'store']);
    // Route::update('jobs', [JobOpeningController::class, 'store']);
});