<?php

namespace App\Http\Requests\Admin\FoodEntry;

use App\Transfers\FoodEntry\UpdateTransfer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'date_time' => 'required|string|date_format:d.m.Y H:i',
            'calories' => 'required|numeric|max:3000|min:0',
            'price' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * @return UpdateTransfer
     */
    public function makeTransferObject(): UpdateTransfer
    {
        return new UpdateTransfer(
            $this->input('name'),
            $this->date('date_time'),
            $this->input('calories'),
            $this->input('price')
        );
    }
}
