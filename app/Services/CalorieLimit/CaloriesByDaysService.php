<?php

namespace App\Services\CalorieLimit;

use App\Http\Requests\CalorieLimit\CaloriesByDaysRequest;
use App\Models\FoodEntry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CaloriesByDaysService
{
    /**
     * @param CaloriesByDaysRequest $request
     * @return Collection
     */
    public function getCalories(CaloriesByDaysRequest $request): Collection
    {
        return FoodEntry::select([
            DB::raw("(sum(calories)) as calories_sum"),
            DB::raw("(DATE_FORMAT(date_time, '%d-%m-%Y')) as date_day")
        ])
            ->where([
                'user_id' => Auth::id(),
                ['date_time', '>=', $request->date('date_from')->startOfDay()],
                ['date_time', '<', $request->date('date_to')->addDay()->startOfDay()],
            ])
            ->orderBy(DB::raw("STR_TO_DATE(date_day,'%d-%m-%Y')"), 'desc')
            ->groupBy(DB::raw("DATE_FORMAT(date_time, '%d-%m-%Y')"))
            ->get();
    }
}
