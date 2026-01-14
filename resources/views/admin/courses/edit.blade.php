<x-app-layout>
    <x-slot name="header">Edit course</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    @include('admin.courses.partials.form', ['course' => $course])
                    <div class="flex gap-3">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                        <a class="px-4 py-2 rounded border" href="{{ route('admin.courses.show', $course) }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
