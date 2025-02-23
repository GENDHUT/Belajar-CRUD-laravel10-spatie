<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6 border-b border-gray-300 dark:border-gray-700 pb-2">Detail Buku</h2>
                    
                    @if (isset($buku) && $buku)
                        <div class="flex items-start space-x-6">
                            @if ($buku->gambar)
                                <img src="{{ asset('storage/gambar_buku/' . $buku->gambar) }}" 
                                     alt="{{ $buku->judul }}" 
                                     class="w-40 h-60 object-cover rounded shadow-md">
                            @else
                                <div class="flex items-center justify-center w-40 h-60 bg-gray-200 dark:bg-gray-700 text-gray-500 text-sm rounded shadow-md">
                                    Tidak ada gambar
                                </div>
                            @endif

                            <div class="flex-1">
                                <p class="text-xl font-semibold mb-2">{{ $buku->judul }}</p>
                                <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                    <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                                    <p><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>
                                    <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                                </div>

                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Deskripsi:</strong></p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        {{ $buku->deskripsi ?? 'Deskripsi tidak tersedia.' }}
                                    </p>
                                </div>

                                {{-- Badge Kategori --}}
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Kategori:</strong></p>
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        @if ($buku->kategori->isEmpty())
                                            <span class="text-gray-500">Tidak ada kategori</span>
                                        @else
                                            @foreach ($buku->kategori as $kategoriItem)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-200">
                                                    {{ $kategoriItem->nama_kategori }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Ulasan --}}
                        @if ($buku->ulasan->isEmpty())
                            <p class="text-gray-500">Belum ada ulasan untuk buku ini.</p>
                        @else
                            <div class="space-y-4">
                                @foreach ($buku->ulasan as $ulasan)
                                    <div class="border border-gray-300 dark:border-gray-700 p-4 rounded-lg">
                                        <p class="text-sm text-white-600 dark:text-white-400">
                                            <strong>{{ $ulasan->user->name }}</strong> - 
                                            <span class="text-yellow-500">⭐ {{ $ulasan->rating }}/5</span>
                                        </p>
                                        <p class="text-sm mt-2 text-gray-900 dark:text-gray-200">{{ $ulasan->ulasan }}</p>
                                        
                                        <!-- Tombol Hapus -->
                                        @if ($ulasan->user_id === Auth::id()) <!-- Pastikan hanya user yang membuat ulasan yang bisa menghapus -->
                                            <form action="{{ route('ulasan.destroy', $ulasan->id) }}" method="POST" class="mt-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 flex space-x-4 rounded">
                                                    Hapus Ulasan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                            
                        {{-- Navigasi --}}
                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('ulasan.create', ['buku_id' => $buku->id]) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded ">
                                ⭐ Rating
                            </a>
                            <a href="{{ route('dashboard') }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">
                                Kembali
                            </a>
                        </div>
                    @else
                        <p>Data buku tidak ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>