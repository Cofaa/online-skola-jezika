<x-app-layout>
    <x-slot name="header">Available sessions</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 text-left">Course</th>
                            <th class="p-3 text-left">Teacher</th>
                            <th class="p-3 text-left">Starts</th>
                            <th class="p-3 text-left">Duration</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sessions as $s)
                            <tr class="border-t">
                                <td class="p-3">
                                    {{ $s->course?->title }} ({{ $s->course?->level }})
                                </td>
                                <td class="p-3">{{ $s->teacher?->name ?? '—' }}</td>
                                <td class="p-3">{{ \Illuminate\Support\Carbon::parse($s->starts_at)->format('Y-m-d H:i') }}</td>
                                <td class="p-3">{{ $s->duration_minutes }} min</td>
                                <td class="p-3 text-right">
                                    <form method="POST" action="{{ route('student.sessions.book', $s) }}">
                                        @csrf
                                        <button class="bg-blue-600 text-white px-3 py-1 rounded">
                                            Book
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="p-3 text-gray-500" colspan="5">No available sessions.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>{{ $sessions->links() }}</div>
        </div>
    </div>
</x-app-layout>
