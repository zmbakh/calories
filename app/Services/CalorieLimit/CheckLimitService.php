<?php

namespace App\Services\CalorieLimit;

use App\Models\FoodEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use JetBrains\PhpStorm\ArrayShape;

class CheckLimitService
{
    #[ArrayShape(['calories_for_today' => "float", 'calorie_limit' => "int"])]
    public function check(): array
    {
        $calories = Cache::remember(
            Auth::user()->getCaloriesForTodayCacheKey(),
            900,
            fn() => $this->getCaloriesForToday(),
        );

        return [
            'calories_for_today' => $calories,
            'calorie_limit' => Auth::user()->calorie_limit,
        ];
    }

    /**
     * @return float
     */
    protected function getCaloriesForToday(): float
    {
        return FoodEntry::where('date_time', '>=', now()->startOfDay())
            ->where('date_time', '<', now()->addDay()->startOfDay())
            ->where('user_id', Auth::id())
            ->sum('calories');
    }
}
