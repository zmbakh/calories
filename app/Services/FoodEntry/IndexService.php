<?php

namespace App\Services\FoodEntry;

use App\Http\Requests\FoodEntry\IndexRequest;
use App\Models\FoodEntry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class IndexService
{
    /**
     * @param IndexRequest $request
     * @return mixed
     */
    public function getFoodEntries(IndexRequest $request):LengthAwarePaginator
    {
        $foodEntries = FoodEntry::where('user_id', Auth::id());

        if ($request->input('date_from')) {
            $foodEntries->where('date_time', '>=', $request->date('date_from')->startOfDay());
        }
        if ($request->input('date_to')) {
            $foodEntries->where('date_time', '<',$request->date('date_to')->addDay()->startOfDay());
        }

        return $foodEntries->paginate();
    }
}
