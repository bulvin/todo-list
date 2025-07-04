<x-layout>
    <x-slot:heading>
        To-Do List
    </x-slot:heading>

    <x-alert/>

    <div class="flex flex-wrap gap-6 items-start">
        @foreach(\App\Enums\TodoStatus::cases() as $status)
            <x-todo-column
                :title="$status->label()"
                :todos="$todos->where('status', $status->value)"
            />
        @endforeach
    </div>
</x-layout>
