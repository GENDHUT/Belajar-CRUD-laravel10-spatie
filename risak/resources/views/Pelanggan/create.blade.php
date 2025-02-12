<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Tambah Pelanggan</h2>
                    <form method="POST" action="{{ route('pelanggan.store') }}">
                        @csrf

                        <!-- Nama Pelanggan -->
                        <div class="mb-4">
                            <x-input-label for="nama_pelanggan" :value="__('Nama Pelanggan')" />
                            <x-text-input id="nama_pelanggan" class="block mt-1 w-full" type="text" name="nama_pelanggan" :value="old('nama_pelanggan')" required autofocus autocomplete="nama_pelanggan" />
                            <x-input-error :messages="$errors->get('nama_pelanggan')" class="mt-2" />
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="alamat">{{ old('alamat') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-4">
                            <x-input-label for="nomor_telpon" :value="__('Nomor Telepon')" />
                            <x-text-input id="nomor_telepon" class="block mt-1 w-full" type="text" name="nomor_telepon" :value="old('nomor_telepon')" required autocomplete="nomor_telepon" />
                            <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('pelanggan.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
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
