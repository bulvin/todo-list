<div class="bg-white rounded-lg shadow p-4 min-w-0 flex-auto">
    <h2 class="text-lg font-semibold mb-4">{{ $title }}</h2>
    <div class="space-y-2">
        @forelse($todos as $todo)
            <x-todo-card :todo="$todo" />
        @empty
            <div class="text-gray-400 text-sm">No todos</div>
        @endforelse
    </div>
</div>
