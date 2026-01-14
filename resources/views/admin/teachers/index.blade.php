<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Teachers
            </h2>
            <a href="{{ route('admin.teachers.create') }}" class="px-4 py-2 rounded bg-gray-900 text-white hover:bg-gray-800">
                + New teacher
            </a>
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
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($teachers as $t)
                        <tr class="border-t">
                            <td class="p-3">{{ $t->name }}</td>
                            <td class="p-3">{{ $t->email }}</td>
                            <td class="p-3 text-right">
                                <form class="inline"
                                      method="POST"
                                      action="{{ route('admin.teachers.destroy', $t) }}"
                                      onsubmit="return confirm('Delete this teacher?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-t">
                            <td class="p-3 text-gray-600" colspan="3">No teachers found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $teachers->links() }}
        </div>
    </div>
</x-app-layout>
