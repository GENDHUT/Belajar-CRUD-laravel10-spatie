<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Tambah Pesanan</h2>
                    <form method="POST" action="{{ route('pesanan.store') }}">
                        @csrf
                        
                        <!-- Pilih Menu -->
                        <div class="mb-4">
                            <x-input-label for="menu_id" :value="__('Pilih Menu')" />
                            <select id="menu_id" name="menu_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm">
                                <option value="">-- Pilih Menu --</option>
                                @foreach ($menu as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_menu }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('menu_id')" class="mt-2" />
                        </div>
                        
                        <!-- Jumlah Pesanan -->
                        <div class="mb-4">
                            <x-input-label for="jumlah" :value="__('Jumlah Pesanan')" />
                            <x-text-input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah" :value="old('jumlah')" required autocomplete="jumlah" />
                            <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                        </div>
                        
                         <!-- Pilihan User Berdasarkan Role -->
                         @if(auth()->user()->hasAnyRole(['admin', 'waiter']))
                         <div class="mb-4">
                             <x-input-label for="user_id" :value="__('Pilih User')" />
                             <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm">
                                 <option value="">-- Pilih User --</option>
                                 @foreach ($user as $item)
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                             </select>
                             <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                         </div>
                     @else
                         <div class="mb-4">
                             <x-input-label for="user_id" :value="__('User')" />
                             <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" value="{{ auth()->user()->id }}" readonly />
                             <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                         </div>
                     @endif
                        
                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('pesanan.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
