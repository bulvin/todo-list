<x-layout>
    <x-slot:heading>
        To-Do List
    </x-slot:heading>
    <div class="flex flex-wrap gap-6 items-start">
        <x-todo-column
            title="To-Do"
            :todos="$todos->where('status', 'todo')"
        />
        <x-todo-column
            title="In Progress"
            :todos="$todos->where('status', 'in_progress')"
        />
        <x-todo-column
            title="Done"
            :todos="$todos->where('status', 'done')"
        />
    </div>
</x-layout>
