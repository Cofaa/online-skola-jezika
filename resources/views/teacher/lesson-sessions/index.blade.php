<x-app-layout>
    <x-slot name="header">My sessions</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between">
                <div class="text-gray-600">Only your sessions are visible here.</div>
                <a href="{{ route('teacher.lesson-sessions.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded">
                    + New session
                </a>
            </div>

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 text-left">Course</th>
                            <th class="p-3 text-left">Starts at</th>
                            <th class="p-3 text-left">Duration</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sessions as $session)
                            <tr class="border-t">
                                <td class="p-3">
                                    {{ $session->course?->title }}
                                    <div class="text-xs text-gray-500">{{ $session->course?->level }}</div>
                                </td>
                                <td class="p-3">{{ \Illuminate\Support\Carbon::parse($session->starts_at)->format('Y-m-d H:i') }}</td>
                                <td class="p-3">{{ $session->duration_minutes }} min</td>
                                <td class="p-3">{{ $session->status }}</td>
                                <td class="p-3 text-right space-x-3">
                                    <a class="text-blue-600" href="{{ route('teacher.lesson-sessions.show', $session) }}">View</a>
                                    <a class="text-indigo-600" href="{{ route('teacher.lesson-sessions.edit', $session) }}">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-3 text-gray-500" colspan="5">No sessions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>{{ $sessions->links() }}</div>
        </div>
    </div>
</x-app-layout>
