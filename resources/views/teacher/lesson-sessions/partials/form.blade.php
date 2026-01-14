@php
    $value = fn ($key, $default = '') =>
        old($key, $session?->$key ?? $default);
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
    <label class="block text-sm font-medium">Course</label>
    <select name="course_id" class="mt-1 w-full border rounded p-2" required>
        @foreach($courses as $course)
            <option value="{{ $course->id }}" @selected((int)$value('course_id') === $course->id)>
                {{ $course->title }} ({{ $course->level }})
            </option>
        @endforeach
    </select>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium">Starts at</label>
        <input name="starts_at" type="datetime-local"
               class="mt-1 w-full border rounded p-2"
               value="{{ $value('starts_at') ? \Illuminate\Support\Carbon::parse($value('starts_at'))->format('Y-m-d\TH:i') : '' }}"
               required>
    </div>

    <div>
        <label class="block text-sm font-medium">Duration (minutes)</label>
        <input name="duration_minutes" type="number" min="15" max="240"
               class="mt-1 w-full border rounded p-2"
               value="{{ $value('duration_minutes', 60) }}"
               required>
    </div>
</div>

<div>
    <label class="block text-sm font-medium">Status</label>
    <select name="status" class="mt-1 w-full border rounded p-2" required>
        @foreach(['scheduled','cancelled','completed'] as $st)
            <option value="{{ $st }}" @selected($value('status', 'scheduled') === $st)>{{ $st }}</option>
        @endforeach
    </select>
</div>
