<?php

use App\Http\Controllers\Api\GoogleAuthController;
use App\Http\Controllers\Api\OnboardingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/user',
    fn (Request $request) => $request->user()
)->middleware('auth:sanctum');

Route::post('/auth/google', [GoogleAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/onboarding', [OnboardingController::class, 'onboard']);
});
