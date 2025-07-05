<x-layout>
    <x-slot:heading>
        To-Do List
    </x-slot:heading>

    <x-slot:toolbar>
        <x-todo-filter-form :filters="$filters" />
    </x-slot:toolbar>

    <x-alert />

    <div class="flex flex-wrap gap-6 items-start">
        @foreach(\App\Enums\TodoStatus::cases() as $status)
            <x-todo-column
                :title="$status->label()"
                :todos="$todos->get($status->value, collect())"
            />
        @endforeach
    </div>
</x-layout>
