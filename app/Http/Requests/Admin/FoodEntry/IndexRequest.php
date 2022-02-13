<?php

namespace App\Http\Requests\Admin\FoodEntry;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_ids' => 'sometimes|required|array|min:1',
            'user_ids.*' => 'required|int',
            'date_from' => 'nullable|date_format:d.m.Y',
            'date_to' => 'nullable|date_format:d.m.Y',
        ];
    }
}
