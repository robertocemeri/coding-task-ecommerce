<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'title' => ['required','min:4', 'max:50'],
            'description' => ['required', 'string'],
            'picture' => [],
            'start_price' => ['required'],
            'buy_now_price' => ['required'],
            'price_steps' => ['required'],
            'start_time' => ['required'],
        ];
    }
}
