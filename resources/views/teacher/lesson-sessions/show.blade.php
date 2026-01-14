<x-app-layout>
    <x-slot name="header">Session details</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6 space-y-2">
                <div class="text-xl font-semibold">{{ $session->course?->title }} ({{ $session->course?->level }})</div>

                <div class="grid grid-cols-2 gap-2 text-sm pt-3">
                    <div><b>Starts:</b> {{ \Illuminate\Support\Carbon::parse($session->starts_at)->format('Y-m-d H:i') }}</div>
                    <div><b>Duration:</b> {{ $session->duration_minutes }} min</div>
                    <div><b>Status:</b> {{ $session->status }}</div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a class="px-4 py-2 rounded border" href="{{ route('teacher.lesson-sessions.index') }}">← Back</a>

                <div class="flex gap-3">
                    <a class="px-4 py-2 rounded border" href="{{ route('teacher.lesson-sessions.edit', $session) }}">Edit</a>

                    <form method="POST" action="{{ route('teacher.lesson-sessions.destroy', $session) }}"
                          onsubmit="return confirm('Delete this session?');">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 rounded bg-red-600 text-white">Delete</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
