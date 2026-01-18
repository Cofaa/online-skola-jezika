<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin dashboard
            </h2>
            <span class="text-sm text-gray-600">
                Upravljaj kursevima, sesijama i predavačima.
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded p-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('admin.courses.index') }}"
                   class="group bg-white border rounded-2xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold">Courses</div>
                        <div class="text-gray-400 group-hover:text-gray-600 transition">→</div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        CRUD nad kursevima (naslov, nivo, cena, aktivan).
                    </div>
                </a>

                <a href="{{ route('admin.lesson-sessions.index') }}"
                   class="group bg-white border rounded-2xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold">Sessions</div>
                        <div class="text-gray-400 group-hover:text-gray-600 transition">→</div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        Pregled svih termina + brisanje (moderacija).
                    </div>
                </a>

                <a href="{{ route('admin.teachers.index') }}"
                   class="group bg-white border rounded-2xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold">Teachers</div>
                        <div class="text-gray-400 group-hover:text-gray-600 transition">→</div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        Dodavanje i brisanje učitelja (role=teacher).
                    </div>
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                   class="group bg-white border rounded-2xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold">Bookings</div>
                        <div class="text-gray-400 group-hover:text-gray-600 transition">→</div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        Potvrđivanje i upravljanje rezervacijama.
                    </div>
                </a>
            </div>

            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <div class="font-semibold">Quick notes</div>
                <ul class="mt-2 text-sm text-gray-600 list-disc ms-5 space-y-1">
                    <li>Admin rute su zaštićene middleware-om <code class="bg-gray-100 px-1 rounded">role:admin</code>.</li>
                    <li>Teachers i Sessions su odvojeni od student/teacher dashboard-a.</li>
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
