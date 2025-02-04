<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Daftar Album</h3>
                    <div class="mt-6 mb-6">
                        <a href="{{ route('albums.create') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" style="background-color: rgb(0, 217, 255); color:white;">
                            Buat Album
                        </a>
                    </div>
                    <!-- Grid Container: 1 kolom di mobile, 2 di sm, 4 di md ke atas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($album as $item)
                            <a href="{{ route('albums.show', $item->id) }}" class="group block">
                                <div class="relative rounded-lg overflow-hidden shadow-md">
                                    @php
                                        // Ambil foto pertama dari album, pastikan relasi di model Album bernama 'foto'
                                        $firstFoto = $item->foto->first();
                                    @endphp
                                    <img src="{{ $firstFoto && $firstFoto->lokasi_file ? asset('storage/' . $firstFoto->lokasi_file) : asset('images/default-placeholder.jpg') }}" 
                                         alt="Gambar {{ $item->nama_album }}" 
                                         class="object-cover w-full h-64 transition-transform duration-300 group-hover:scale-105">
                                    
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-end p-4">
                                        <h4 class="text-lg font-bold text-white">
                                            {{ $item->nama_album }}
                                        </h4>
                                        <p class="text-sm text-white">
                                            {{ Str::limit($item->deskripsi, 150, '...') }}
                                        </p>
                                        <div class="text-xs text-gray-200 mt-1">
                                            Tanggal Dibuat: <strong>{{ $item->created_at->format('d M Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    
                    <!-- Tombol Kembali -->
                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" style="background-color: rgb(0, 217, 255); color:white;">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
