<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (Auth()->user()->hasRole('admin') || Auth()->user()->hasRole('petugas'))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-6">{{ __("You're logged in!") }}</p>
                    <div class="mb-6">
                        <a href="{{ route('buku.index') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                            Buku
                        </a>
                    </div>

                    <!-- Role -->
                    <div class="mt-6 p-4 border rounded-lg bg-gray-100 dark:bg-gray-700">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Role Anda:</h3>
                        @foreach (auth()->user()->getRoleNames() as $role)
                            <div class="bg-blue-500 text-white py-1 px-4 rounded mb-2 inline-block">
                                {{ $role }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Daftar Buku</h3>
                    
                    <!-- Loop daftar buku -->
                    <div class="space-y-6">
                        @foreach ($buku as $item)
                            <div class="flex items-start bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                                <!-- Gambar Buku -->
                                <img src="{{ asset('storage/gambar_buku/' . $item->gambar) }}" 
                                     alt="Gambar {{ $item->judul }}" 
                                     class="w-24 h-32 object-cover rounded-md shadow-md">

                                <!-- Informasi Buku -->
                                <div class="ml-4 flex-1">
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                                        {{ $item->judul }}
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ Str::limit($item->deskripsi, 150, '...') }}
                                    </p>

                                    <!-- Detail Informasi -->
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-3 space-x-4">
                                        <span>Penulis: <strong>{{ $item->penulis }}</strong></span>
                                        <span>Penerbit: <strong>{{ $item->penerbit }}</strong></span>
                                        <span>Tahun: <strong>{{ $item->tahun_terbit }}</strong></span>
                                    </div>

                                    <!-- Aksi -->
                                    <div class="mt-4 flex space-x-2">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('buku.show', $item->id) }}" 
                                           class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                            Lihat Detail
                                        </a>
                                        <!-- Tombol Tambah ke Koleksi -->
                                        <form action="{{ route('koleksi.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="buku_id" value="{{ $item->id }}">
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                                                Tambah ke Koleksi
                                            </button>
                                        </form>
                                        <!-- Tombol Rating -->
                                        <a href="{{ route('ulasan.create', ['buku_id' => $item->id]) }}" 
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                             ⭐ Rating
                                         </a>
                                        <!-- Tombol Pinjam Buku -->
                                        @if ($item->status == 'tersedia')
                                            <form action="{{ route('peminjaman.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="buku_id" value="{{ $item->id }}">
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">
                                                    📖 Pinjam Buku
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-red-500 font-bold">Buku sedang dipinjam</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
