<?php

use App\Http\Controllers\Admin\Food\FoodEntryController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('food-entries', FoodEntryController::class);
Route::apiResource('users', UserController::class)->only('index');
Route::get('report/entries-added', [ReportController::class, 'entriesAdded']);
Route::get('report/average-calories', [ReportController::class, 'averageCalories']);
