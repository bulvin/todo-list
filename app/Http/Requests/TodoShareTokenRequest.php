<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoShareTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'days' => 'required|integer|min:1|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'days.required' => 'The number of days is required.',
            'days.min' => 'The number of days must be at least 1.',
            'days.max' => 'The number of days may not be greater than 30.',
        ];
    }
}
