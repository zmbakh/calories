<?php

namespace App\Services\FoodEntry;

use App\Models\FoodEntry;
use App\Transfers\FoodEntry\StoreTransfer;

class StoreService
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
     * @param StoreTransfer $transfer
     * @return FoodEntry
     */
    public function store(StoreTransfer $transfer): FoodEntry
    {
        $foodEntry = $this->storeFoodEntry($transfer);

        $this->cacheForgetService->forgetCache($transfer->user);

        return $foodEntry;
    }

    /**
     * @param StoreTransfer $transfer
     * @return FoodEntry
     */
    protected function storeFoodEntry(StoreTransfer $transfer): FoodEntry
    {
        $foodEntry = new FoodEntry();
        $foodEntry->name = $transfer->name;
        $foodEntry->calories = $transfer->calories;
        $foodEntry->date_time = $transfer->dateTime;
        $foodEntry->price = $transfer->price;
        $foodEntry->user_id = $transfer->user->id;
        $foodEntry->save();

        return $foodEntry;
    }
}
