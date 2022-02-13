<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\Report\AverageCaloriesResource;
use App\Http\Resources\Report\EntriesAddedResource;
use App\Services\Admin\Report\AverageCaloriesService;
use App\Services\Admin\Report\EntriesAddedService;

class ReportController extends Controller
{
    /**
     * @param EntriesAddedService $service
     * @return EntriesAddedResource
     */
    public function entriesAdded(EntriesAddedService $service): EntriesAddedResource
    {
        return new EntriesAddedResource($service->getReport());
    }

    /**
     * @param AverageCaloriesService $service
     * @return AverageCaloriesResource
     */
    public function averageCalories(AverageCaloriesService $service): AverageCaloriesResource
    {
        return new AverageCaloriesResource($service->getAverageCalories());
    }
}
