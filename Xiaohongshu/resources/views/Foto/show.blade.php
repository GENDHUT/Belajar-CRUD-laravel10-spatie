<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6 border-b border-gray-300 dark:border-gray-700 pb-2">
                        Detail Foto
                    </h2>
                    
                    @if (isset($foto) && $foto)
                        <!-- Tampilan Gambar secara Full -->
                        @if ($foto->lokasi_file)
                            <div class="mb-6">
                                <img src="{{ asset('storage/' . $foto->lokasi_file) }}" 
                                     alt="{{ $foto->judul_foto }}" 
                                     class="w-[450px] h-[auto] object-contain rounded shadow-md">
                            </div>
                        @else
                            <div class="mb-6 flex items-center justify-center w-full h-64 bg-gray-200 dark:bg-gray-700 text-gray-500 text-sm rounded shadow-md">
                                Tidak ada gambar
                            </div>
                        @endif

                        <!-- Detail Informasi Foto -->
                        <div class="space-y-4">
                            <p class="text-2xl font-semibold">{{ $foto->judul_foto }}</p>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Deskripsi:</strong></p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $foto->deskripsi_foto ?? 'Deskripsi tidak tersedia.' }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    <strong>Tanggal Unggah:</strong> 
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $foto->tanggal_unggah }}</span>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Tombol Navigasi -->
                        <div class="mt-6">
                            <a href="{{ route('dashboard') }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">
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
