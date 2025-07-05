@props(['todo'])

<div class="bg-gray-100 rounded p-3 relative group hover:bg-gray-200 transition">
    <a href="{{ route('todos.show', $todo->id) }}" class="block cursor-pointer">
        <div class="flex items-center justify-between">
            <div class="font-medium">{{ $todo->name }}</div>
            <span class="ml-2 px-2 py-1 rounded text-xs font-semibold {{ $todo->priority->color() }}">
                {{ $todo->priority->label() }}
            </span>
        </div>
        <div class="text-xs text-gray-400 mt-1">
            Due: {{ $todo->due_date->format('d F Y') }}
        </div>
    </a>
    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-1 py-0.5 text-[10px] font-medium text-white bg-red-500 rounded hover:bg-red-600">
            Delete
        </button>
    </form>
</div>
