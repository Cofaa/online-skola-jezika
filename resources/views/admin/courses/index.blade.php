<x-app-layout>
    <x-slot name="header">Courses</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between">
                <div class="text-gray-600">Manage all courses</div>
                <a href="{{ route('admin.courses.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded">
                    + New course
                </a>
            </div>

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 text-left">Title</th>
                            <th class="p-3 text-left">Level</th>
                            <th class="p-3 text-left">Price</th>
                            <th class="p-3 text-left">Active</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr class="border-t">
                                <td class="p-3">{{ $course->title }}</td>
                                <td class="p-3">{{ $course->level }}</td>
                                <td class="p-3">{{ number_format((float)$course->price, 2) }} €</td>
                                <td class="p-3">{{ $course->is_active ? 'Yes' : 'No' }}</td>
                                <td class="p-3 text-right space-x-3">
                                    <a class="text-blue-600" href="{{ route('admin.courses.show', $course) }}">View</a>
                                    <a class="text-indigo-600" href="{{ route('admin.courses.edit', $course) }}">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-3 text-gray-500" colspan="5">No courses yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                {{ $courses->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
