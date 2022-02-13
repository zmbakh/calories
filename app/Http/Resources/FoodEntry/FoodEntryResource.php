<?php

namespace App\Http\Resources\FoodEntry;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date_time' => $this->date_time,
            'calories' => $this->calories,
            'price' => $this->price,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
