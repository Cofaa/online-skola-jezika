<x-app-layout>
    <x-slot name="header">Course details</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6 space-y-2">
                <div class="text-xl font-semibold">{{ $course->title }}</div>
                <div class="text-gray-600">{{ $course->description ?? '—' }}</div>

                <div class="pt-3 grid grid-cols-2 gap-2 text-sm">
                    <div><b>Level:</b> {{ $course->level }}</div>
                    <div><b>Price:</b> {{ number_format((float)$course->price, 2) }} €</div>
                    <div><b>Active:</b> {{ $course->is_active ? 'Yes' : 'No' }}</div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a class="px-4 py-2 rounded border" href="{{ route('admin.courses.index') }}">← Back</a>

                <div class="flex gap-3">
                    <a class="px-4 py-2 rounded border" href="{{ route('admin.courses.edit', $course) }}">Edit</a>

                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                          onsubmit="return confirm('Delete this course?');">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 rounded bg-red-600 text-white">Delete</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
