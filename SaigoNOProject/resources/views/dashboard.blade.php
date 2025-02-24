<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Navigation Links -->
            <div class="mb-8 flex flex-wrap justify-center gap-4">
            @if (Auth()->user()->hasRole('admin|owner'))
                <a href="{{ route('menu.index') }}"
                   class="flex-1 max-w-xs bg-green-500 hover:bg-green-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                    Menu
                </a>

                @if (Auth()->user()->hasRole('admin|owner|waiter'))
                <a href="{{ route('pesanan.index') }}"
                   class="flex-1 max-w-xs bg-purple-500 hover:bg-purple-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                    Pesanan
                </a>
                @endif

                @if (Auth()->user()->hasRole('admin|owner|kasir'))
                <a href="{{ route('transaksi.index') }}"
                   class="flex-1 max-w-xs bg-blue-500 hover:bg-blue-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                    Transaksi
                </a>
                @endif

                @if (Auth()->user()->hasRole('admin'))
                <a href="{{ route('user.index') }}"
                   class="flex-1 max-w-xs bg-yellow-500 hover:bg-yellow-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                    User
                </a>
                @endif               
            @endif 
            <a href="{{ route('pesanan.create') }}"
                class="flex-1 max-w-xs bg-purple-500 hover:bg-purple-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                 Pesanan
                </a>
                {{-- @if (Auth()->user()->hasRole('admin'))
                    <a href="{{ route('users.index') }}"
                    class="flex-1 max-w-xs bg-red-500 hover:bg-red-600 text-white py-4 px-6 rounded-lg shadow-lg text-center font-semibold transition-colors duration-200">
                        Users
                    </a>
                @endif --}}
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

    <!-- My Orders Section -->
    <div class="mt-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Pesanan Saya</h3>
        @if($pesanan->isNotEmpty())
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">No</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Pesanan</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Jumlah</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Status</th>
                            <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Harga Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($pesanan as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $item->menu->nama_menu ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->menu)
                                        {{ $item->menu->harga * $item->jumlah }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-400 mt-4">Anda belum memiliki pesanan.</p>
        @endif
    </div>
    
    
</x-app-layout>
