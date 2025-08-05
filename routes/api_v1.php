<?php

use App\Http\Controllers\Api\V1\JobApplicationController;
use App\Http\Controllers\Api\V1\JobOpeningController;
use App\Http\Controllers\Api\V1\JobPostController;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/***Jobs Routes V1 */
Route::apiResource('jobs', JobOpeningController::class);
Route::post('jobs/{id}/apply', [JobApplicationController::class, 'apply']);

Route::middleware('auth:sanctum')->prefix('my')->group(function () {
    Route::apiResource('jobs', JobPostController::class);
    // Route::patch('jobs/{id}', [JobPostController::class, 'update']);
    Route::get('jobs/{id}/applications', [JobApplicationController::class, 'jobApplications']);
});