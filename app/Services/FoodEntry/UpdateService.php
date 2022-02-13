<?php

namespace App\Services\FoodEntry;

use App\Models\FoodEntry;
use App\Transfers\FoodEntry\UpdateTransfer;

class UpdateService
{
    protected CacheForgetService $cacheForgetService;

    /**
     * @param CacheForgetService $cacheForgetService
     */
    public function __construct(CacheForgetService $cacheForgetService)
    {
        $this->cacheForgetService = $cacheForgetService;
    }

    /**
     * @param FoodEntry $foodEntry
     * @param UpdateTransfer $transfer
     * @return FoodEntry
     */
    public function update(FoodEntry $foodEntry, UpdateTransfer $transfer): FoodEntry
    {
        $foodEntry = $this->storeFoodEntry($foodEntry, $transfer);

        $this->cacheForgetService->forgetCache($foodEntry->user);

        return $foodEntry;
    }

    /**
     * @param FoodEntry $foodEntry
     * @param UpdateTransfer $transfer
     * @return FoodEntry
     */
    protected function storeFoodEntry(FoodEntry $foodEntry, UpdateTransfer $transfer): FoodEntry
    {
        $foodEntry->name = $transfer->name;
        $foodEntry->calories = $transfer->calories;
        $foodEntry->date_time = $transfer->dateTime;
        $foodEntry->price = $transfer->price;
        $foodEntry->save();

        return $foodEntry;
    }
}
