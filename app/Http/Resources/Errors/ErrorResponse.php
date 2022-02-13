<?php

namespace App\Http\Resources\Errors;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResponse extends JsonResource
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
            'message' => $this->resource['message'],
            'errors'  => $this->when(
                $this->resource['errors'] ?? null,
                $this->resource['errors'] ?? null
            ),
        ];
    }
}
