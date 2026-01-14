<x-app-layout>
    <x-slot name="header">My bookings</x-slot>

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
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                            <tr class="border-t">
                                <td class="p-3">
                                    {{ $b->lessonSession?->course?->title }} ({{ $b->lessonSession?->course?->level }})
                                </td>
                                <td class="p-3">{{ $b->lessonSession?->teacher?->name ?? '—' }}</td>
                                <td class="p-3">{{ \Illuminate\Support\Carbon::parse($b->lessonSession?->starts_at)->format('Y-m-d H:i') }}</td>
                                <td class="p-3">{{ $b->status }}</td>
                                <td class="p-3 text-right">
                                    @if($b->status !== 'cancelled')
                                        <form method="POST" action="{{ route('student.bookings.destroy', $b) }}"
                                              onsubmit="return confirm('Cancel booking?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 text-white px-3 py-1 rounded">Cancel</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td class="p-3 text-gray-500" colspan="5">No bookings yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>{{ $bookings->links() }}</div>
        </div>
    </div>
</x-app-layout>
