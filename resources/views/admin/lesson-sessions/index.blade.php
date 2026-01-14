<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sessions
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:underline">Back to admin</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded p-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">Course</th>
                        <th class="p-3 text-left">Teacher</th>
                        <th class="p-3 text-left">Starts</th>
                        <th class="p-3 text-left">Duration</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sessions as $s)
                        <tr class="border-t">
                            <td class="p-3">
                                {{ $s->course?->title }}
                                <div class="text-xs text-gray-500">{{ $s->course?->level }}</div>
                            </td>
                            <td class="p-3">{{ $s->teacher?->name }}</td>
                            <td class="p-3">{{ $s->starts_at?->format('Y-m-d H:i') }}</td>
                            <td class="p-3">{{ $s->duration_minutes }} min</td>
                            <td class="p-3">{{ $s->status }}</td>
                            <td class="p-3 text-right space-x-3">
                                <a class="text-blue-600 hover:underline" href="{{ route('admin.lesson-sessions.show', $s) }}">View</a>

                                <form class="inline"
                                      method="POST"
                                      action="{{ route('admin.lesson-sessions.destroy', $s) }}"
                                      onsubmit="return confirm('Delete this session?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-t">
                            <td class="p-3 text-gray-600" colspan="6">No sessions found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $sessions->links() }}
        </div>
    </div>
</x-app-layout>
