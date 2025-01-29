    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-semibold mb-6">Edit Buku</h2>
        
                        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')
        
                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                                <input type="text" id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('judul')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <!-- Penulis -->
                            <div>
                                <label for="penulis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penulis</label>
                                <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('penulis')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <!-- Penerbit -->
                            <div>
                                <label for="penerbit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penerbit</label>
                                <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('penerbit')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <!-- Tahun Terbit -->
                            <div>
                                <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Terbit</label>
                                <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('tahun_terbit')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <!-- Deskripsi -->
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" rows="5"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                                @error('deskripsi')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <!-- Gambar -->
                            <div>
                                <label for="gambar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar</label>
                                <input type="file" id="gambar" name="gambar" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @if ($buku->gambar)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/gambar_buku/' . $buku->gambar) }}" alt="Gambar Buku" class="w-32 h-32 object-cover rounded-md">
                                </div>
                                @endif
                                @error('gambar')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
        
                            <!-- Tombol -->
                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('buku.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Batal</a>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </x-app-layout>
        

        