<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Tambah Produk</h2>
                    <form method="POST" action="{{ route('produk.store') }}">
                        @csrf
                        
                        <!-- Nama Produk -->
                        <div class="mb-4">
                            <x-input-label for="nama_produk" :value="__('Nama Produk')" />
                            <x-text-input id="nama_produk" class="block mt-1 w-full" type="text" name="nama_produk" :value="old('nama_produk')" required autofocus autocomplete="nama_produk" />
                            <x-input-error :messages="$errors->get('nama_produk')" class="mt-2" />
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <x-input-label for="harga" :value="__('Harga')" />
                            <x-text-input id="harga" class="block mt-1 w-full" type="number" step="0.01" name="harga" :value="old('harga')" required autocomplete="harga" />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <!-- Stok -->
                        <div class="mb-4">
                            <x-input-label for="stok" :value="__('Stok')" />
                            <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok')" required autocomplete="stok" />
                            <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('produk.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
