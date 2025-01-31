<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex space-x-2">
                        <a href="{{ route('buku.create') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                            Tambah Buku
                        </a>
                        <a href="{{ route('kategori.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                            kategori
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">No</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Gambar</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Judul</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Penulis</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Penerbit</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Tahun Terbit</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Kategori</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $item)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/gambar_buku/' . $item->gambar) }}" alt="Gambar {{ $item->judul }}" class="w-20 h-20 object-cover rounded">
                                    @else
                                        <img src="{{ asset('images/default-placeholder.png') }}" alt="Placeholder" class="w-20 h-20 object-cover rounded">
                                    @endif
                                </td>
                                <td class="py-2 px-4">{{ $item->judul }}</td>
                                <td class="py-2 px-4">{{ $item->penulis }}</td>
                                <td class="py-2 px-4">{{ $item->penerbit }}</td>
                                <td class="py-2 px-4">{{ $item->tahun_terbit }}</td>
                                <td class="py-2 px-4">
                                    <div>
                                        <div class="mt-1 flex flex-wrap gap-2">
                                            @foreach ($item->kategori as $kategoriItem)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-200">
                                                    {{ $kategoriItem->nama_kategori }}
                                                </span>
                                            @endforeach
                                        </div>
                                        @error('kategori')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </td>
                                <td class="py-2 px-4 flex space-x-2">
                                    <a href="{{ route('buku.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">Detail</a>
                                    <a href="{{ route('buku.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">Edit</a>
                                    <form action="{{ route('buku.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
