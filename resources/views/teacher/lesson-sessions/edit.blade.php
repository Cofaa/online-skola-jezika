<x-app-layout>
    <x-slot name="header">Edit session</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('teacher.lesson-sessions.update', $session) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    @include('teacher.lesson-sessions.partials.form', ['session' => $session, 'courses' => $courses])

                    <div class="flex gap-3">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                        <a class="px-4 py-2 rounded border" href="{{ route('teacher.lesson-sessions.show', $session) }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
