<x-layout>
    <x-slot:heading>
        Add Todo
    </x-slot:heading>
    <form action="{{ route('todos.store') }}" method="POST" class="max-w-lg mx-auto space-y-8 p-8 bg-gray-50 rounded-lg shadow">
        @csrf

        <div>
            <label for="name" class="block text-base font-medium text-gray-900 mb-2">Name</label>
            <input type="text" name="name" id="name" required
                   class="mt-2 block w-full rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3 px-4 @error('name') @enderror"
                   value="{{ old('name') }}">
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-base font-medium text-gray-900 mb-2">Description (Optional)</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-2 block w-full rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3 px-4 @error('description') @enderror">{{ old('description') }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="priority" class="block text-base font-medium text-gray-900 mb-2">Priority</label>
            <select name="priority" id="priority" required
                    class="mt-2 block w-full rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3 px-4 @error('priority') @enderror">
                @foreach(\App\Enums\TodoPriority::cases() as $priority)
                    <option value="{{ $priority->value }}" @selected(old('priority', 'medium') == $priority->value)>
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
            <select name="status" id="status" required
                    class="mt-2 block w-full rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3 px-4 @error('status') @enderror">
                @foreach(\App\Enums\TodoStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected(old('status', 'todo') == $status->value)>
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
            <input type="date" name="due_date" id="due_date" required
                   class="mt-2 block w-full rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3 px-4 @error('due_date') @enderror"
                   value="{{ old('due_date') }}">
            @error('due_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-x-6 mt-6">
            <a href="{{ route('todos.index') }}" class="text-base font-semibold text-gray-700 hover:underline">Cancel</a>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow hover:bg-indigo-500">
                Save
            </button>
        </div>
    </form>
</x-layout>
