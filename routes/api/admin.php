<?php

use App\Http\Controllers\Admin\Food\FoodEntryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('food-entries', FoodEntryController::class);
