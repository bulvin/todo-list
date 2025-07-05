@props(['name', 'label', 'options', 'selected'])

<div>
    <label class="block text-sm font-medium mb-1">{{ $label }}</label>
    <select name="{{ $name }}" class="rounded border-gray-300">
        <option value="">All</option>
        @foreach ($options as $option)
            <option value="{{ $option->value }}" {{ $selected === $option->value ? 'selected' : '' }}>
                {{ $option->label() }}
            </option>
        @endforeach
    </select>
</div>
