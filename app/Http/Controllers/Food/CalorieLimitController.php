<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalorieLimit\CaloriesByDaysRequest;
use App\Http\Resources\CalorieLimit\CaloriesForTodayResource;
use App\Http\Resources\CaloriesByDaysResource;
use App\Services\CalorieLimit\CaloriesByDaysService;
use App\Services\CalorieLimit\CheckLimitService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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

    /**
     * @param CaloriesByDaysService $service
     * @param CaloriesByDaysRequest $request
     * @return AnonymousResourceCollection
     */
    public function caloriesByDays(CaloriesByDaysService $service, CaloriesByDaysRequest $request): AnonymousResourceCollection
    {
        return CaloriesByDaysResource::collection($service->getCalories($request));
    }
}
