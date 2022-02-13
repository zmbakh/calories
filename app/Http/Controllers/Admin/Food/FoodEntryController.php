<?php

namespace App\Http\Controllers\Admin\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FoodEntry\IndexRequest;
use App\Http\Requests\Admin\FoodEntry\StoreRequest;
use App\Http\Resources\FoodEntry\FoodEntryResource;
use App\Models\FoodEntry;
use App\Services\Admin\FoodEntry\IndexService;
use App\Services\FoodEntry\StoreService;
use Illuminate\Http\Request;

class FoodEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexService $service, IndexRequest $request)
    {
        return FoodEntryResource::collection($service->getFoodEntries($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreService $service
     * @param StoreRequest $request
     * @return FoodEntryResource
     */
    public function store(StoreService $service, StoreRequest $request): FoodEntryResource
    {
        $foodEntry = $service->store($request->makeTransferObject());

        $foodEntry->load('user');

        return new FoodEntryResource($foodEntry);
    }

    /**
     * Display the specified resource.
     *
     * @param FoodEntry $foodEntry
     * @return FoodEntryResource
     */
    public function show(FoodEntry $foodEntry): FoodEntryResource
    {
        $foodEntry->load('user');
        return new FoodEntryResource($foodEntry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FoodEntry $foodEntry
     */
    public function destroy(FoodEntry $foodEntry)
    {
        $foodEntry->delete();
    }
}
