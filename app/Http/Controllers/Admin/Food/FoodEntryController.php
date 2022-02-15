<?php

namespace App\Http\Controllers\Admin\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FoodEntry\IndexRequest;
use App\Http\Requests\Admin\FoodEntry\StoreRequest;
use App\Http\Requests\Admin\FoodEntry\UpdateRequest;
use App\Http\Resources\FoodEntry\FoodEntryResource;
use App\Models\FoodEntry;
use App\Services\Admin\FoodEntry\IndexService;
use App\Services\FoodEntry\CacheForgetService;
use App\Services\FoodEntry\StoreService;
use App\Services\FoodEntry\UpdateService;

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
     * @param FoodEntry $foodEntry
     * @param UpdateService $service
     * @param UpdateRequest $request
     * @return FoodEntryResource
     */
    public function update(FoodEntry $foodEntry, UpdateService $service, UpdateRequest $request): FoodEntryResource
    {
        return new FoodEntryResource($service->update($foodEntry, $request->makeTransferObject()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FoodEntry $foodEntry
     * @param CacheForgetService $cacheForgetService
     */
    public function destroy(FoodEntry $foodEntry, CacheForgetService $cacheForgetService)
    {
        $foodEntry->delete();
        $cacheForgetService->forgetCache($foodEntry->user);
    }
}
