<?php

namespace App\Http\Requests;

use App\Enums\TodoPriority;
use App\Enums\TodoStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTodoRequest extends FormRequest
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
        $todo = $this->route('todo');

        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'priority' => ['required', Rule::enum(TodoPriority::class)],
            'status' => ['required', Rule::enum(TodoStatus::class)],
            'due_date' => [
                'required',
                'date',
                'after_or_equal:' . $todo->due_date->format('Y-m-d'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name must not exceed 255 characters.',
            'description.max' => 'The description must not exceed 1000 characters.',
            'priority.required' => 'Please select a priority.',
            'status.required' => 'Please select a status.',
            'due_date.required' => 'The due date is required.',
            'due_date.after_or_equal' => 'The due date must be a future date.',
        ];
    }
}
