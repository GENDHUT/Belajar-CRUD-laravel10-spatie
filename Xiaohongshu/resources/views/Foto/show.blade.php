<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold border-b pb-2 mb-6">
                        Detail Foto
                    </h2>
                    
                    @if (isset($foto) && $foto)
                        <!-- Tampilan Gambar -->
                        @if ($foto->lokasi_file)
                            <div class="mb-6 flex justify-center">
                                <img src="{{ asset('storage/' . $foto->lokasi_file) }}" 
                                     alt="{{ $foto->judul_foto }}" 
                                     class="w-[450px] object-contain rounded shadow-md">
                            </div>
                        @else
                            <div class="mb-6 flex items-center justify-center w-full h-64 bg-gray-200 dark:bg-gray-700 text-gray-500 text-sm rounded shadow-md">
                                Tidak ada gambar
                            </div>
                        @endif

                        <!-- Detail Informasi Foto dengan Tombol Like di sebelah kanan -->
                        <div class="flex justify-between items-start">
                            <!-- Kolom informasi -->
                            <div>
                                <p class="text-2xl font-semibold">{{ $foto->judul_foto }}</p>
                                
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        <strong>Deskripsi:</strong>
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $foto->deskripsi_foto ?? 'Deskripsi tidak tersedia.' }}
                                    </p>
                                </div>
                                
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        <strong>Tanggal Unggah:</strong>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $foto->tanggal_unggah }}</span>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kolom tombol like -->
                            <div class="flex flex-col items-end">
                                <form action="{{ route('foto.like', $foto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                        @if($foto->likes->where('user_id', Auth::id())->count())
                                            Unlike
                                        @else
                                            Like
                                        @endif
                                    </button>
                                </form>
                                <span class="mt-2 text-gold-600">{{ $foto->likes->count() }} Likes</span>
                            </div>
                        </div>
                        
                        <!-- Form Komentar -->
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold mb-4">Komentar</h3>
                            <form action="{{ route('foto.comment', $foto->id) }}" method="POST">
                                @csrf
                                <textarea name="isi_komentar" class="w-full text-black p-2 border rounded" rows="3" placeholder="Tulis komentar..."></textarea>
                                <button type="submit" class="mt-2 bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                                    Kirim Komentar
                                </button>
                            </form>
                        </div>
                        
                        <!-- Daftar Komentar -->
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold mb-4">Komentar yang Ada</h3>
                            @forelse ($foto->comments as $comment)
                                <div class="border-b pb-2 mb-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-bold">
                                            {{ $comment->user->name }} 
                                            <span class="text-gray-500 text-xs">
                                                {{ $comment->created_at->format('d M Y') }}
                                            </span>
                                        </p>
                                        <p class="text-sm">{{ $comment->isi_komentar }}</p>
                                    </div>
                                    @if(Auth::id() === $comment->user_id)
                                        <form action="{{ route('foto.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500">Belum ada komentar.</p>
                            @endforelse
                        </div>
                        
                        <!-- Tombol Navigasi -->
                        <div class="mt-6">
                            <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">
                                Kembali
                            </a>
                        </div>
                    @else
                        <p>Data foto tidak ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
