<x-app-layout>
    <x-slot name="header">Student dashboard</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <p>Ulogovan kao <b>STUDENT</b>.</p>
                 <div class="mt-3 flex gap-3">
                    <a href="{{ route('student.sessions.index') }}" class="bg-blue-600 text-black px-4 py-2 rounded">Browse sessions</a>
                    <a href="{{ route('student.bookings.index') }}" class="px-4 py-2 rounded border">My bookings</a>
                </div>
            </div>
           

        </div>
    </div>
</x-app-layout>
