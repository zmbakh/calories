<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Food\CalorieLimitController;
use App\Http\Controllers\Food\FoodEntryController;
use App\Http\Controllers\Food\MoneyLimitController;
use Illuminate\Support\Facades\Route;

Route::get('users/profile', [UserController::class, 'profile']);
Route::apiResource('food-entries', FoodEntryController::class);
Route::get('calories-limit/check', [CalorieLimitController::class, 'check']);
Route::get('calories-limit/by-days', [CalorieLimitController::class, 'caloriesByDays']);
Route::get('money-limit/check-for-month', [MoneyLimitController::class, 'checkForMonth']);
