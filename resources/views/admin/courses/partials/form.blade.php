@php
    $value = fn ($key, $default = '') =>
        old($key, $course?->$key ?? $default);
@endphp

@if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <label class="block text-sm font-medium">Title</label>
    <input name="title" class="mt-1 w-full border rounded p-2" value="{{ $value('title') }}" required>
</div>

<div>
    <label class="block text-sm font-medium">Description</label>
    <textarea name="description" class="mt-1 w-full border rounded p-2" rows="4">{{ $value('description') }}</textarea>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Level</label>
        <select name="level" class="mt-1 w-full border rounded p-2" required>
            @foreach(['A1','A2','B1','B2','C1','C2'] as $lvl)
                <option value="{{ $lvl }}" @selected($value('level') === $lvl)>{{ $lvl }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium">Price (€)</label>
        <input name="price" type="number" step="0.01" min="0"
               class="mt-1 w-full border rounded p-2"
               value="{{ $value('price', 0) }}" required>
    </div>
</div>

<div class="flex items-center gap-2">
    <input id="is_active" name="is_active" type="checkbox" value="1"
           class="rounded"
           @checked((bool)$value('is_active', true))>
    <label for="is_active" class="text-sm">Active</label>
</div>
