<?php

namespace App\Http\Resources\CalorieLimit;

use Illuminate\Http\Resources\Json\JsonResource;

class CaloriesForTodayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'limit_exceeded' => $this->resource['calories_for_today'] > $this->resource['calorie_limit'],
            'calories_for_today' => $this->resource['calories_for_today'],
            'calorie_limit' => $this->resource['calorie_limit'],
        ];
    }
}
