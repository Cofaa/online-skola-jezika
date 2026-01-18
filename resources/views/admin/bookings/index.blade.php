<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Bookings
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

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 rounded p-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">Student</th>
                        <th class="p-3 text-left">Course</th>
                        <th class="p-3 text-left">Teacher</th>
                        <th class="p-3 text-left">Session Date</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Created</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-t">
                            <td class="p-3">
                                {{ $booking->student?->name }}
                                <div class="text-xs text-gray-500">{{ $booking->student?->email }}</div>
                            </td>
                            <td class="p-3">
                                {{ $booking->lessonSession?->course?->title }}
                                <div class="text-xs text-gray-500">{{ $booking->lessonSession?->course?->level }}</div>
                            </td>
                            <td class="p-3">{{ $booking->lessonSession?->teacher?->name }}</td>
                            <td class="p-3">{{ $booking->lessonSession?->starts_at?->format('Y-m-d H:i') }}</td>
                            <td class="p-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $booking->created_at?->format('Y-m-d H:i') }}</td>
                            <td class="p-3 text-right space-x-2">
                                @if($booking->status === 'pending')
                                    <form class="inline"
                                          method="POST"
                                          action="{{ route('admin.bookings.confirm', $booking) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="text-green-600 hover:underline">
                                            Confirm
                                        </button>
                                    </form>

                                    <form class="inline"
                                          method="POST"
                                          action="{{ route('admin.bookings.cancel', $booking) }}"
                                          onsubmit="return confirm('Cancel this booking?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="text-red-600 hover:underline">
                                            Cancel
                                        </button>
                                    </form>
                                @elseif($booking->status === 'confirmed')
                                    <form class="inline"
                                          method="POST"
                                          action="{{ route('admin.bookings.cancel', $booking) }}"
                                          onsubmit="return confirm('Cancel this booking?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="text-red-600 hover:underline">
                                            Cancel
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400">No actions</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-500">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
