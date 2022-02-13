<?php

namespace App\Services\MoneyLimit;

use App\Models\FoodEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CheckLimitService
{
    /**
     * @return float
     */
    public function getMoneySpent(): float
    {
        return Cache::remember(
            Auth::user()->getMoneySpentCacheKey(),
            900,
            fn() => $this->moneySpentThisMonth(),
        );
    }

    /**
     * @return float
     */
    protected function moneySpentThisMonth(): float
    {
        return FoodEntry::where('date_time', '>=', now()->startOfMonth())
            ->where('date_time', '<', now()->addDay()->startOfDay())
            ->where('user_id', Auth::id())
            ->sum('price');
    }
}
