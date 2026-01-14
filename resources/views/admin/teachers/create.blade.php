<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create teacher
            </h2>
            <a href="{{ route('admin.teachers.index') }}" class="text-sm text-gray-600 hover:underline">Back</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('admin.teachers.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Name</label>
                        <input name="name" value="{{ old('name') }}" class="mt-1 w-full border rounded p-2" required>
                        @error('name') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}" class="mt-1 w-full border rounded p-2" required>
                        @error('email') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Password</label>
                        <input name="password" type="password" class="mt-1 w-full border rounded p-2" required>
                        @error('password') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Confirm password</label>
                        <input name="password_confirmation" type="password" class="mt-1 w-full border rounded p-2" required>
                    </div>

                    <button class="px-4 py-2 rounded bg-gray-900 text-white hover:bg-gray-800" type="submit">
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
