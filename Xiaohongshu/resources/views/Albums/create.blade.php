<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Buat Album Baru</h3>

                    <form method="POST" action="{{ route('albums.store') }}">
                        @csrf

                        <!-- Form untuk Nama Album -->
                        <div class="mb-4">
                            <x-input-label for="nama_album" :value="__('Nama Album')" />
                            <x-text-input id="nama_album" name="nama_album" type="text" value="{{ old('nama_album') }}" 
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                required />
                            <x-input-error :messages="$errors->get('nama_album')" class="mt-2" />
                        </div>

                        <!-- Form untuk Deskripsi Album -->
                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi Album')" />
                            <textarea id="deskripsi" name="deskripsi" rows="3" 
                                class="block mt-1 w-full dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <!-- Grid Foto: Tampilkan hanya foto yang belum memiliki album -->
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold mb-4">Pilih Foto untuk Ditambahkan ke Album</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                                @foreach ($foto as $item)
                                    <label for="foto-{{ $item->id }}" class="group block cursor-pointer">
                                        <div class="relative rounded-lg overflow-hidden shadow-md border border-gray-300 dark:border-gray-700">
                                            <img src="{{ asset('storage/' . $item->lokasi_file) }}" 
                                                 alt="Gambar {{ $item->judul_foto }}" 
                                                 class="object-cover w-full h-64 transition-transform duration-300 group-hover:scale-105">
                                            
                                            <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-end p-4">
                                                <h4 class="text-lg font-bold text-white">{{ $item->judul_foto }}</h4>
                                                <p class="text-sm text-gray-200">{{ Str::limit($item->deskripsi_foto, 100, '...') }}</p>
                                                <div class="text-xs text-gray-300 mt-1">
                                                    Tanggal Unggah: <strong>{{ $item->tanggal_unggah }}</strong>
                                                </div>
                                            </div>

                                            <input type="checkbox" name="foto_id[]" id="foto-{{ $item->id }}" value="{{ $item->id }}" 
                                                class="absolute top-2 right-2 w-6 h-6 text-indigo-600 bg-white border-gray-300 rounded focus:ring-indigo-500">
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('foto_id')" class="mt-2" />
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('albums.index') }}" 
                               class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Album') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
