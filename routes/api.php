<?php

use App\Http\Controllers\Api\GoogleAuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OnboardingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());
    Route::get('/home', [HomeController::class, 'index']);
    Route::post('/onboarding', [OnboardingController::class, 'onboard']);
});

Route::post('/auth/google', [GoogleAuthController::class, 'login']);
