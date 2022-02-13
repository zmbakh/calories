<?php

namespace App\Services\FoodEntry;

use App\Http\Requests\FoodEntry\StoreRequest;
use App\Models\FoodEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class StoreService
{
    /**
     * @param StoreRequest $request
     * @return FoodEntry
     */
    public function store(StoreRequest $request): FoodEntry
    {
        $foodEntry = $this->storeFoodEntry($request);

        $this->forgetCache();

        return $foodEntry;
    }

    /**
     * @param StoreRequest $request
     * @return FoodEntry
     */
    protected function storeFoodEntry(StoreRequest $request): FoodEntry
    {
        $foodEntry = new FoodEntry();
        $foodEntry->name = $request->input('name');
        $foodEntry->calories = $request->input('calories');
        $foodEntry->date_time = $request->date('date_time');
        $foodEntry->price = $request->input('price');
        $foodEntry->user_id = Auth::id();
        $foodEntry->save();

        return $foodEntry;
    }

    /**
     * @return void
     */
    protected function forgetCache()
    {
        Cache::forget(Auth::user()->getCaloriesForTodayCacheKey());
        Cache::forget(Auth::user()->getMoneySpentCacheKey());
    }
}
