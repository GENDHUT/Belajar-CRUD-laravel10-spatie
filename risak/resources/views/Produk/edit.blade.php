<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Edit Produk</h2>
        
                    <form action="{{ route('produk.update', $produk->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
        
                        <!-- Nama Produk -->
                        <div>
                            <label for="nama_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Produk</label>
                            <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('nama_produk')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Harga -->
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                            <input type="number" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" 
                                step="0.01"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('harga')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Stok -->
                        <div>
                            <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok</label>
                            <input type="number" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('stok')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Tombol Aksi -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('produk.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
