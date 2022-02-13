<?php

namespace App\Http\Resources\MoneyLimit;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class MoneySpentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    #[ArrayShape(['limit_exceeded' => "bool", 'money' => "float", 'monthly_limit' => "int"])]
    public function toArray($request): array
    {
        return [
            'limit_exceeded' => $this->resource > User::MONTHLY_MONEY_LIMIT,
            'money' => $this->resource,
            'monthly_limit' => User::MONTHLY_MONEY_LIMIT,
        ];
    }
}
