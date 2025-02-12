<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Edit Pelanggan</h2>
    
                    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
    
                        <!-- Nama Pelanggan -->
                        <div>
                            <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Pelanggan
                            </label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" 
                                   value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                   required>
                            @error('nama_pelanggan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Alamat
                            </label>
                            <textarea id="alamat" name="alamat" rows="3" 
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                      required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                            @error('alamat')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <!-- Nomor Telepon -->
                        <div>
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nomor Telepon
                            </label>
                            <input type="text" id="nomor_telepon" name="nomor_telepon" 
                                   value="{{ old('nomor_telepon', $pelanggan->nomor_telepon) }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                   required>
                            @error('nomor_telepon')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <!-- Tombol Aksi -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('pelanggan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
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
