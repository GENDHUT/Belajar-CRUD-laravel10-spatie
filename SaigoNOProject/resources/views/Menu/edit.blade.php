<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Edit menu</h2>
        
                    <form action="{{ route('menu.update', $menu->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
        
                        <!-- Nama menu -->
                        <div>
                            <label for="nama_menu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama menu</label>
                            <input type="text" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('nama_menu')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Harga -->
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                            <input type="number" id="harga" name="harga" value="{{ old('harga', $menu->harga) }}" 
                                step="0.01"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('harga')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Tombol Aksi -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('menu.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
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