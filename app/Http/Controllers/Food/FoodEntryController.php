<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodEntry\IndexRequest;
use App\Http\Requests\FoodEntry\StoreRequest;
use App\Http\Resources\FoodEntry\FoodEntryResource;
use App\Models\FoodEntry;
use App\Services\FoodEntry\IndexService;
use App\Services\FoodEntry\StoreService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FoodEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexService $service
     * @param IndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(IndexService $service, IndexRequest $request): AnonymousResourceCollection
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
        return new FoodEntryResource($service->store($request->makeTransferObject()));
    }

    /**
     * Display the specified resource.
     *
     * @param FoodEntry $foodEntry
     * @return FoodEntryResource
     */
    public function show(FoodEntry $foodEntry): FoodEntryResource
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
