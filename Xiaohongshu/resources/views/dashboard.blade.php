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
                </div>               
             </div>  
        </div>
    </div>     
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Daftar Foto</h3>
                    
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
