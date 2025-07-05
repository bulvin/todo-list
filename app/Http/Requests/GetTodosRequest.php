<?php

namespace App\Http\Requests;

use App\Enums\TodoDueDateFilter;
use App\Enums\TodoPriority;
use App\Enums\TodoStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetTodosRequest extends FormRequest
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
            'status' => ['nullable', Rule::enum(TodoStatus::class)],
            'priority' => ['nullable', Rule::enum(TodoPriority::class)],
            'due_date' => ['nullable', Rule::enum(TodoDueDateFilter::class)],
        ];
    }
}
