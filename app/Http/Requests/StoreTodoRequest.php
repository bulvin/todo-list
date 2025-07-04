<?php

namespace App\Http\Requests;

use App\Enums\TodoPriority;
use App\Enums\TodoStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable|string', 'max:1000'],
            'priority' => ['required', Rule::enum(TodoPriority::class)],
            'status' => ['required', Rule::enum(TodoStatus::class)],
            'due_date' => ['required', 'date', 'after_or_equal:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.max' => 'The description must not exceed 1000 characters.',
            'priority.required' => 'Please select a priority.',
            'status.required' => 'Please select a status.',
            'due_date.required' => 'The due date is required.',
            'due_date.after_or_equal' => 'The due date must be a future date.',
        ];
    }

}
