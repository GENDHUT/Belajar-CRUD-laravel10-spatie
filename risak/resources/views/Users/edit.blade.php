<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Role User Anda: ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-white text-2xl font-bold mb-6">Edit User Role</h1>

                <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Nama Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-white">Nama:</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-white">Role:</label>
                        <select id="role" name="role"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Batal</a>
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
