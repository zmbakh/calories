<?php

namespace App\Services\FoodEntry;

use App\Models\FoodEntry;
use App\Models\User;
use App\Transfers\FoodEntry\StoreTransfer;
use Illuminate\Support\Facades\Cache;

class StoreService
{
    /**
     * @param StoreTransfer $transfer
     * @return FoodEntry
     */
    public function store(StoreTransfer $transfer): FoodEntry
    {
        $foodEntry = $this->storeFoodEntry($transfer);

        $this->forgetCache($transfer->user);

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

    /**
     * @return void
     */
    protected function forgetCache(User $user)
    {
        Cache::forget($user->getCaloriesForTodayCacheKey());
        Cache::forget($user->getMoneySpentCacheKey());
    }
}
