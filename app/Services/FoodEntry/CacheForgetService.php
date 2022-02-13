<?php

namespace App\Services\FoodEntry;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class CacheForgetService
{
    /**
     * @return void
     */
    public function forgetCache(User $user)
    {
        Cache::forget($user->getCaloriesForTodayCacheKey());
        Cache::forget($user->getMoneySpentCacheKey());
    }
}
