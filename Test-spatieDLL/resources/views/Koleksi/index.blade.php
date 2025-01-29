<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Tombol Kembali ke Dashboard -->
                    <div class="mb-6">
                        <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                            Kembali ke Dashboard
                        </a>
                    </div>

                    <h2 class="text-2xl font-bold mb-6 border-b border-gray-300 dark:border-gray-700 pb-2">Koleksi Pribadi</h2>

                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($koleksi as $item)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow-md">
                                <!-- Gambar Buku -->
                                @if ($item->buku->gambar)
                                    <img src="{{ asset('storage/gambar_buku/' . $item->buku->gambar) }}" 
                                         alt="{{ $item->buku->judul }}" 
                                         class="w-full h-48 object-cover rounded mb-4">
                                @else
                                    <div class="w-full h-48 bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-500 text-sm rounded mb-4">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <!-- Informasi Buku -->
                                <p class="font-bold text-lg mb-2">{{ $item->buku->judul }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Penulis:</strong> {{ $item->buku->penulis }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Penerbit:</strong> {{ $item->buku->penerbit }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Tahun:</strong> {{ $item->buku->tahun_terbit }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4"><strong>Deskripsi:</strong> {{ Str::limit($item->buku->deskripsi, 100, '...') }}</p>

                                <!-- Aksi -->
                                <div class="flex justify-between items-center mt-4">
                                    <!-- Hapus Koleksi -->
                                    <form action="{{ route('koleksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku dari koleksi?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                                            Hapus
                                        </button>
                                    </form>

                                    <!-- Tombol Detail -->
                                    <a href="{{ route('buku.show', $item->buku->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        @empty
                            <!-- Jika Koleksi Kosong -->
                            <p class="text-gray-500 dark:text-gray-300 col-span-full text-center">Belum ada koleksi. Tambahkan buku ke koleksi Anda!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
