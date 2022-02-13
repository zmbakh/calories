<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CaloriesByDaysResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'date' => $this->resource['date_day'],
            'calories' => $this->resource['calories_sum'],
        ];
    }
}
