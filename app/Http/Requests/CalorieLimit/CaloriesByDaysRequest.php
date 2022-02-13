<?php

namespace App\Http\Requests\CalorieLimit;

use Illuminate\Foundation\Http\FormRequest;

class CaloriesByDaysRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_from' => 'required|date_format:d.m.Y',
            'date_to' => 'required|date_format:d.m.Y',
        ];
    }
}
