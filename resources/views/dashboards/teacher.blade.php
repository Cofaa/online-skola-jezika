<x-app-layout>
    <x-slot name="header">Teacher dashboard</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <p>Ulogovan kao <b>TEACHER</b>.</p>
                <p class="mt-2 text-sm text-gray-600">Ovde ćemo dodati upravljanje terminima.</p>
                <a href="{{ route('teacher.lesson-sessions.index') }}" class="inline-block mt-3 bg-blue-600 text-black px-4 py-2 rounded">
    Manage my sessions
</a>

            </div>
        </div>
    </div>
</x-app-layout>
