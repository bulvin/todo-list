@php
    $isEdit = request()->query('edit') === 'true';
@endphp

<x-layout>
    <x-slot:heading>
        {{ $isEdit ? 'Todo Edit' : 'Todo Details' }}
    </x-slot:heading>
    <x-alert/>
    <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="max-w-lg mx-auto space-y-8 p-8 bg-gray-50 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-base font-medium text-gray-900 mb-2">Name</label>
            <input type="text" name="name" id="name" {{ $isEdit ? 'required' : 'disabled' }}
            class="mt-2 block w-full rounded-md border border-gray-300 {{ $isEdit ? 'bg-white focus:border-indigo-500 focus:ring-indigo-500' : 'bg-gray-100' }} shadow-sm text-base py-3 px-4 @error('name') border-red-600 @enderror"
                   value="{{ old('name', $todo->name) }}">
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-base font-medium text-gray-900 mb-2">Description</label>
            <textarea name="description" id="description" rows="6" {{ $isEdit ? '' : 'disabled' }}
            class="mt-2 block w-full rounded-md border border-gray-300 {{ $isEdit ? 'bg-white focus:border-indigo-500 focus:ring-indigo-500' : 'bg-gray-100' }} shadow-sm text-base py-4 px-4 resize-y min-h-[120px] @error('description') border-red-600 @enderror">{{ old('description', $todo->description) }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="priority" class="block text-base font-medium text-gray-900 mb-2">Priority</label>
            <select name="priority" id="priority" {{ $isEdit ? 'required' : 'disabled' }}
            class="mt-2 block w-full rounded-md border border-gray-300 {{ $isEdit ? 'bg-white focus:border-indigo-500 focus:ring-indigo-500' : 'bg-gray-100' }} shadow-sm text-base py-3 px-4 @error('priority') border-red-600 @enderror">
                @foreach(\App\Enums\TodoPriority::cases() as $priority)
                    <option value="{{ $priority->value }}" @selected(old('priority', $todo->priority) == $priority->value)>
                        {{ $priority->label() }}
                    </option>
                @endforeach
            </select>
            @error('priority')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status" class="block text-base font-medium text-gray-900 mb-2">Status</label>
            <select name="status" id="status" {{ $isEdit ? 'required' : 'disabled' }}
            class="mt-2 block w-full rounded-md border border-gray-300 {{ $isEdit ? 'bg-white focus:border-indigo-500 focus:ring-indigo-500' : 'bg-gray-100' }} shadow-sm text-base py-3 px-4 @error('status') border-red-600 @enderror">
                @foreach(\App\Enums\TodoStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected(old('status', $todo->status) == $status->value)>
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
            @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="due_date" class="block text-base font-medium text-gray-900 mb-2">Due Date</label>
            <input type="date" name="due_date" id="due_date" {{ $isEdit ? 'required' : 'disabled' }}
            class="mt-2 block w-full rounded-md border border-gray-300 {{ $isEdit ? 'bg-white focus:border-indigo-500 focus:ring-indigo-500' : 'bg-gray-100' }} shadow-sm text-base py-3 px-4 @error('due_date') border-red-600 @enderror"
                   value="{{ old('due_date', $todo->due_date->format('Y-m-d')) }}">
            @error('due_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-x-6 mt-6">
            <a href="{{ $isEdit ? route('todos.show', $todo->id) : route('todos.index') }}" class="text-base font-semibold text-gray-700 hover:underline">Cancel</a>

            @if($isEdit)
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow hover:bg-indigo-500">
                    Save
                </button>
            @else
                <a href="{{ route('todos.show', $todo->id) }}?edit=true"
                   class="rounded-md bg-yellow-500 px-6 py-3 text-base font-semibold text-white shadow hover:bg-yellow-400">
                    Edit
                </a>
            @endif
        </div>
    </form>
</x-layout>
