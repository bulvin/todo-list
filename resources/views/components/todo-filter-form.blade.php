@props(['filters'])

<form method="GET" class="flex flex-wrap gap-4 items-end">

    <x-todo-filter-select
        name="status"
        label="Status"
        :options="\App\Enums\TodoStatus::cases()"
        :selected="$filters['status'] ?? ''"
    />

    <x-todo-filter-select
        name="priority"
        label="Priority"
        :options="\App\Enums\TodoPriority::cases()"
        :selected="$filters['priority'] ?? ''"
    />

    <x-todo-filter-select
        name="due_date"
        label="Due Date"
        :options="\App\Enums\TodoDueDateFilter::cases()"
        :selected="$filters['due_date'] ?? ''"
    />

    <div class="flex gap-2">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Filter
        </button>

        <a href="{{ route('todos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Clear
        </a>
    </div>
</form>
