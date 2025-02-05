<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6 border-b border-gray-300 dark:border-gray-700 pb-2">
                        Detail Album: {{ $album->nama_album }}
                    </h2>
                    
                    <!-- Informasi Album -->
                    <div class="mb-6">
                        <p class="text-lg text-gray-800 dark:text-gray-200">{{ $album->deskripsi }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-4">Tanggal Dibuat: <strong>{{ $album->created_at->format('d M Y') }}</strong></p>
                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Pemilik: <strong>{{ $album->user->name }}</strong>
                    </p>
                    
                    
                    <!-- Daftar Foto dalam Album -->
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Foto dalam Album</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <!-- Memastikan foto terkait ada -->
                        @foreach ($album->foto as $item)
                            <a href="{{ route('foto.show', $item->id) }}" class="group block">
                                <div class="relative rounded-lg overflow-hidden shadow-md">
                                    <img src="{{ $item->lokasi_file ? asset('storage/' . $item->lokasi_file) : asset('images/default-placeholder.jpg') }}" 
                                         alt="Gambar {{ $item->judul_foto }}" 
                                         class="object-cover w-full h-64 transition-transform duration-300 group-hover:scale-105">
                                    
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-end p-4">
                                        <h4 class="text-lg font-bold text-white">
                                            {{ $item->judul_foto }}
                                        </h4>
                                        <p class="text-sm text-white">
                                            {{ Str::limit($item->deskripsi_foto, 150, '...') }}
                                        </p>
                                        
                                        <div class="text-xs text-gray-200 mt-1">
                                            Tanggal Unggah: <strong>{{ $item->tanggal_unggah }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="mt-6">
                        <a href="{{ route('albums.index') }}" class="inline-block bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600">
                            Kembali ke Daftar Album
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
