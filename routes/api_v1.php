<?php

use App\Http\Controllers\Api\V1\JobOpeningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function(){
// });
Route::apiResource('jobs', JobOpeningController::class);