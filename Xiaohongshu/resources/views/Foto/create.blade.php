<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Tambah Foto</h2>
                    <form method="POST" action="{{ route('foto.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Upload Foto -->
                        <div class="mb-4">
                            <x-input-label for="lokasi_file" :value="__('Foto')" />
                            <input id="lokasi_file" type="file" name="lokasi_file" class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('lokasi_file')" class="mt-2" />
                        </div>

                        <!-- Judul Foto -->
                        <div class="mb-4">
                            <x-input-label for="judul_foto" :value="__('Judul Foto')" />
                            <x-text-input id="judul_foto" class="block mt-1 w-full" type="text" name="judul_foto" :value="old('judul_foto')" required autofocus />
                            <x-input-error :messages="$errors->get('judul_foto')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <x-input-label for="deskripsi_foto" :value="__('Deskripsi')" />
                            <textarea id="deskripsi_foto" name="deskripsi_foto" class="block mt-1 w-full dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi_foto') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi_foto')" class="mt-2" />
                        </div>

                        <!-- Tanggal Unggah -->
                        <div class="mb-4">
                            <x-input-label for="tanggal_unggah" :value="__('Tanggal Unggah')" />
                            <x-text-input id="tanggal_unggah" class="block mt-1 w-full" type="date" name="tanggal_unggah" value="{{ old('tanggal_unggah', date('Y-m-d')) }}" required />
                            <x-input-error :messages="$errors->get('tanggal_unggah')" class="mt-2" />
                        </div>

                        <!-- Pilih Album -->
                        <div class="mb-4">
                            <x-input-label for="album_id" :value="__('Album')" />
                            <div class="flex space-x-4">
                                <!-- Dropdown Album -->
                                <select id="album_id" name="album_id" class="block mt-1 w-full dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="" selected>-- Pilih Album --</option>
                                    @foreach($album as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_album }}</option>
                                    @endforeach
                                </select>

                                <!-- Album Baru -->
                                <button type="button" id="showNewAlbumInput" class="bg-yellow-500 hover:bg-yellow-700 text-black hover:text-blue-800 mt-1 rounded">
                                    Tambah Album Baru
                                </button>
                            </div>

                            <div id="newAlbumInput" class="mt-4 hidden">
                                <x-input-label for="nama_album_baru" :value="__('Nama Album Baru')" />
                                <x-text-input id="nama_album_baru" class="block mt-1 w-full" type="text" name="nama_album_baru" value="{{ old('nama_album_baru') }}" placeholder="Masukkan nama album baru" />
                                <x-input-error :messages="$errors->get('nama_album_baru')" class="mt-2" />

                                <!-- Deskripsi Album Baru -->
                                <x-input-label for="deskripsi_album" :value="__('Deskripsi Album Baru')" class="mt-4" />
                                <textarea id="deskripsi_album" name="deskripsi_album" class="block mt-1 w-full dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi_album') }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi_album')" class="mt-2" />
                            </div>

                            <x-input-error :messages="$errors->get('album_id')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('foto.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
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

    <!-- JS album baru -->
    <script>
        document.getElementById('showNewAlbumInput').addEventListener('click', function() {
            document.getElementById('newAlbumInput').classList.toggle('hidden');
            document.getElementById('album_id').value = ''; 
        });
    </script>
</x-app-layout>
