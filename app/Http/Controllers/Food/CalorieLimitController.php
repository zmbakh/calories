<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Http\Resources\CalorieLimit\CaloriesForTodayResource;
use App\Services\CalorieLimit\CheckLimitService;
use Illuminate\Http\Request;

class CalorieLimitController extends Controller
{
    /**
     * @param CheckLimitService $service
     * @return CaloriesForTodayResource
     */
    public function check(CheckLimitService $service): CaloriesForTodayResource
    {
        return new CaloriesForTodayResource($service->check());
    }
}
