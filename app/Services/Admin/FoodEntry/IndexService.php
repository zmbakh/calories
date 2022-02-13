<?php

namespace App\Services\Admin\FoodEntry;

use App\Http\Requests\Admin\FoodEntry\IndexRequest;
use App\Models\FoodEntry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexService
{
    /**
     * @param IndexRequest $request
     * @return LengthAwarePaginator
     */
    public function getFoodEntries(IndexRequest $request): LengthAwarePaginator
    {
        $foodEntries = FoodEntry::orderBy('date_time', 'desc')->orderBy('id', 'desc');

        if ($request->input('date_from')) {
            $foodEntries->where('date_time', '>=', $request->date('date_from')->startOfDay());
        }
        if ($request->input('date_to')) {
            $foodEntries->where('date_time', '<',$request->date('date_to')->addDay()->startOfDay());
        }
        if ($request->input('user_ids')) {
            $foodEntries->whereIn('user_id', $request->input('user_ids'));
        }

        return $foodEntries->with('user')->paginate();
    }
}
