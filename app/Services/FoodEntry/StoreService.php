<?php

namespace App\Services\FoodEntry;

use App\Http\Requests\FoodEntry\StoreRequest;
use App\Models\FoodEntry;
use Illuminate\Support\Facades\Auth;

class StoreService
{
    /**
     * @param StoreRequest $request
     * @return FoodEntry
     */
    public function store(StoreRequest $request): FoodEntry
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
}
