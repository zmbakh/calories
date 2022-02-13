<?php

namespace App\Http\Requests\FoodEntry;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_from' => 'nullable|date_format:d.m.Y',
            'date_to' => 'nullable|date_format:d.m.Y',
        ];
    }
}
