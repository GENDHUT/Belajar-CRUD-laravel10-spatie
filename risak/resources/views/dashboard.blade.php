<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Navigation Links -->
            <div class="mb-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('pelanggan.index') }}"
                   class="flex-1 max-w-xs bg-green-500 hover:bg-green-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                    Pelanggan
                </a>
                <a href="{{ route('produk.index') }}"
                   class="flex-1 max-w-xs bg-purple-500 hover:bg-purple-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                    Produk
                </a>
                <a href="{{ route('penjualan.index') }}"
                   class="flex-1 max-w-xs bg-blue-500 hover:bg-blue-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                    Penjualan
                </a>
                @if (Auth()->user()->hasRole('admin'))
                    <a href="{{ route('users.index') }}"
                    class="flex-1 max-w-xs bg-red-500 hover:bg-red-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                        Users
                    </a>
                @endif
            </div>

            <!-- Informasi Tambahan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Role Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200 mb-4">Role Anda:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach (auth()->user()->getRoleNames() as $role)
                            <span class="bg-blue-500 text-white py-1 px-3 rounded-full text-sm">
                                {{ $role }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Logged In Message Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-gray-800 dark:text-gray-200 text-lg">
                        {{ __("You're logged in!") }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
