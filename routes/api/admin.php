<?php

use App\Http\Controllers\Admin\Food\FoodEntryController;
use App\Http\Controllers\Admin\Report\ReportController;
use Illuminate\Support\Facades\Route;

Route::apiResource('food-entries', FoodEntryController::class);
Route::get('report/entries-added', [ReportController::class, 'entriesAdded']);
