<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoneyLimit\MoneySpentResource;
use App\Services\MoneyLimit\CheckLimitService;

class MoneyLimitController extends Controller
{
    /**
     * @param CheckLimitService $service
     * @return MoneySpentResource
     */
    public function checkForMonth(CheckLimitService $service): MoneySpentResource
    {
        return new MoneySpentResource($service->getMoneySpent());
    }
}
