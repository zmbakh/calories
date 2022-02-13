<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Food\CalorieLimitController;
use App\Http\Controllers\Food\FoodEntryController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->withoutMiddleware('auth:sanctum')->group(function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::apiResource('food-entries', FoodEntryController::class);
Route::get('calories-limit/check', [CalorieLimitController::class, 'check']);
Route::get('calories-limit/by-days', [CalorieLimitController::class, 'caloriesByDays']);
