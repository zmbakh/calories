<?php

namespace App\Services\FoodEntry;

use App\Models\FoodEntry;
use App\Models\User;
use App\Transfers\FoodEntry\UpdateTransfer;
use Illuminate\Support\Facades\Cache;

class UpdateService
{
    /**
     * @param FoodEntry $foodEntry
     * @param UpdateTransfer $transfer
     * @return FoodEntry
     */
    public function update(FoodEntry $foodEntry, UpdateTransfer $transfer): FoodEntry
    {
        $foodEntry = $this->storeFoodEntry($foodEntry, $transfer);

        $this->forgetCache($foodEntry->user);

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

    /**
     * @return void
     */
    protected function forgetCache(User $user)
    {
        Cache::forget($user->getCaloriesForTodayCacheKey());
        Cache::forget($user->getMoneySpentCacheKey());
    }
}
