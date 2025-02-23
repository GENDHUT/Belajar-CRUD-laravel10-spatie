<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-6">Daftar Ulasan</h2>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @forelse ($ulasan as $item)
                    <div class="border-b pb-4 mb-4">
                        <p class="text-lg font-semibold">{{ $item->buku->Judul }}</p>
                        <p class="text-gray-600"><strong>{{ $item->user->NamaLengkap }}</strong> - Rating: {{ $item->Rating }}/5</p>
                        <p class="text-gray-800">{{ $item->Ulasan }}</p>

                        @if(auth()->id() == $item->UserID)
                        <div class="mt-2 flex space-x-2">
                            <a href="{{ route('ulasan.edit', $item->UlasanID) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                            <form action="{{ route('ulasan.destroy', $item->UlasanID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada ulasan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
