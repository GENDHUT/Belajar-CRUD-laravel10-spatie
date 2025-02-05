<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (Auth()->user()->hasRole('admin'))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @foreach (auth()->user()->getRoleNames() as $role)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }} 
                    <div class="bg-blue-500"> <p>Role anda: {{$role}}</p></div>
                </div>  
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('foto.index') }}" class="bg-red-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                        Uploads Foto
                    </a>

                    <a href="{{ route('albums.index') }}" class="bg-red-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                        Album
                    </a>
                </div>               
             </div>  
        </div>
    </div>     
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Daftar Foto</h3>
                    
                    <!-- Grid Container: 1 kolom di mobile, 2 di sm, 4 di md ke atas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($foto as $item)
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
                                        
                                        <!-- Tombol Like dan jumlah Like -->
                                        <div class="mt-2 flex items-center space-x-2">
                                            <form action="{{ route('foto.like', $item->id) }}" method="POST" onsubmit="event.stopPropagation();">
                                                @csrf
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded text-xs" onclick="event.stopPropagation();">
                                                    @if($item->likes->where('user_id', Auth::id())->count())
                                                        Unlike
                                                    @else
                                                        Like
                                                    @endif
                                                </button>
                                            </form>
                                            <span class="text-xs text-white">{{ $item->likes->count() }} Likes</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>                
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Daftar Album</h3>
                    
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
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
