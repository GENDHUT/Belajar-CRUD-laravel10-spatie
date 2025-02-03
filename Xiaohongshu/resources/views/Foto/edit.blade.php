<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Edit Foto</h2>
        
                    <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
        
                        <!-- Judul Foto -->
                        <div>
                            <label for="judul_foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul Foto</label>
                            <input type="text" id="judul_foto" name="judul_foto" value="{{ old('judul_foto', $foto->judul_foto) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('judul_foto')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Deskripsi Foto -->
                        <div>
                            <label for="deskripsi_foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Foto</label>
                            <textarea id="deskripsi_foto" name="deskripsi_foto" rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi_foto', $foto->deskripsi_foto) }}</textarea>
                            @error('deskripsi_foto')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label for="lokasi_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar</label>
                            <input type="file" id="lokasi_file" name="lokasi_file" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @if ($foto->lokasi_file)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $foto->lokasi_file) }}" alt="Foto" class="w-32 h-32 object-cover rounded-md">
                                </div>
                            @endif
                            @error('lokasi_file')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tanggal Unggah -->
                        <div class="mb-4">
                            <x-input-label for="tanggal_unggah" :value="__('Tanggal Unggah')" />
                            <x-text-input id="tanggal_unggah" class="block mt-1 w-full" type="date" name="tanggal_unggah" 
                                value="{{ old('tanggal_unggah', $foto->tanggal_unggah) }}" required />
                            <x-input-error :messages="$errors->get('tanggal_unggah')" class="mt-2" />
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('foto.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
