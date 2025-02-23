<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Daftar Kategori</h2>
                    
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="NamaKategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kategori</label>
                            <input type="text" id="NamaKategori" name="NamaKategori" required 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            Tambah Kategori
                        </button>
                    </form>

                    <div class="mt-6">
                        <table class="w-full border-collapse border border-gray-300 text-left">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2 w-12 text-center">#</th>
                                    <th class="border px-4 py-2">Nama Kategori</th>
                                    <th class="border px-4 py-2 w-24 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategori as $item)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border px-4 py-2">{{ $item->NamaKategori }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <form action="{{ route('kategori.destroy', $item->KategoriID) }}" method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-gray-500">Tidak ada kategori tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    