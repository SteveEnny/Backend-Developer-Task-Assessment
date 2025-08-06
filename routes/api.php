<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\JobOpeningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');