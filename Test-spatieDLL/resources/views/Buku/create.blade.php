<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Tambah Buku</h2>
                    <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Upload Gambar -->
                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('Gambar Buku')" />
                            <input id="gambar" type="file" name="gambar" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <!-- Judul Buku -->
                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Buku')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus autocomplete="judul" />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>
    
                        <!-- Penulis -->
                        <div class="mb-4">
                            <x-input-label for="penulis" :value="__('Penulis')" />
                            <x-text-input id="penulis" class="block mt-1 w-full" type="text" name="penulis" :value="old('penulis')" required autofocus autocomplete="penulis" />
                            <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
                        </div>
    
                        <!-- Penerbit -->
                        <div class="mb-4">
                            <x-input-label for="penerbit" :value="__('Penerbit')" />
                            <x-text-input id="penerbit" class="block mt-1 w-full" type="text" name="penerbit" :value="old('penerbit')" required autocomplete="penerbit" />
                            <x-input-error :messages="$errors->get('penerbit')" class="mt-2" />
                        </div>
    
                        <!-- Tahun Terbit -->
                        <div class="mb-4">
                            <x-input-label for="tahun_terbit" :value="__('Tahun Terbit')" />
                            <x-text-input id="tahun_terbit" 
                            class="block mt-1 w-full" 
                            type="number" 
                            name="tahun_terbit" 
                            :value="old('tahun_terbit')" 
                            required 
                            autocomplete="tahun_terbit" 
                            min="1000" 
                            max="{{ date('Y') }}"/>
                            <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-2" />
                        </div>

                        {{-- deskripsi --}}
                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="deskripsi">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>
                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('buku.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
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