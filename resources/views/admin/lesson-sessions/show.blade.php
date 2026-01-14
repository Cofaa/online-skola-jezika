<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Session details
            </h2>
            <a href="{{ route('admin.lesson-sessions.index') }}" class="text-sm text-gray-600 hover:underline">Back</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6 space-y-3">
                <div><span class="text-gray-600">Course:</span> <span class="font-semibold">{{ $session->course?->title }}</span></div>
                <div><span class="text-gray-600">Teacher:</span> <span class="font-semibold">{{ $session->teacher?->name }}</span></div>
                <div><span class="text-gray-600">Starts:</span> {{ $session->starts_at?->format('Y-m-d H:i') }}</div>
                <div><span class="text-gray-600">Duration:</span> {{ $session->duration_minutes }} min</div>
                <div><span class="text-gray-600">Status:</span> {{ $session->status }}</div>

                <div class="pt-4">
                    <form method="POST"
                          action="{{ route('admin.lesson-sessions.destroy', $session) }}"
                          onsubmit="return confirm('Delete this session?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-500">
                            Delete session
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
