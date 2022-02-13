<?php

namespace App\Services\Admin\Report;

use App\Models\FoodEntry;
use JetBrains\PhpStorm\ArrayShape;

class EntriesAddedService
{
    /**
     * @return int[]
     */
    #[ArrayShape(['current_week' => "int", 'previous_week' => "int"])]
    public function getReport(): array
    {
        return [
            'current_week' => $this->currentWeek(),
            'previous_week' => $this->previousWeek(),
        ];
    }

    /**
     * @return int
     */
    protected function currentWeek(): int
    {
        return FoodEntry::where([
            ['date_time', '<', now()->addDay()->startOfDay()],
            ['date_time', '>=', now()->subDays(6)->startOfDay()],
        ])->count();
    }

    /**
     * @return int
     */
    protected function previousWeek(): int
    {
        return FoodEntry::where([
            ['date_time', '<', now()->subDays(6)->startOfDay()],
            ['date_time', '>=', now()->subDays(13)->startOfDay()],
        ])->count();
    }
}
