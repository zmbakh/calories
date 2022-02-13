<?php

namespace App\Http\Requests\Admin\FoodEntry;

use App\Models\User;
use App\Transfers\FoodEntry\StoreTransfer;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'date_time' => 'required|string|date_format:d.m.Y H:i',
            'calories' => 'required|numeric|max:3000|min:0',
            'price' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * @return StoreTransfer
     */
    public function makeTransferObject(): StoreTransfer
    {
        return new StoreTransfer(
            User::findOrFail($this->input('user_id')),
            $this->input('name'),
            $this->date('date_time'),
            $this->input('calories'),
            $this->input('price')
        );
    }
}
