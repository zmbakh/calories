<?php

namespace App\Services\Admin\Report;

use App\Models\FoodEntry;

class AverageCaloriesService
{
    /**
     * @return int
     */
    public function getAverageCalories(): int
    {
        $caloriesSums = FoodEntry::selectRaw('sum(calories) as sum')->where([
            ['date_time', '<', now()->startOfDay()],
            ['date_time', '>=', now()->subDays(7)->startOfDay()],
        ])->groupBy('user_id')->get();

        return $caloriesSums->sum('sum') / $caloriesSums->count();
    }
}
