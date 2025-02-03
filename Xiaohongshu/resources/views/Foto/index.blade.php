<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex space-x-2">
                        <a href="{{ route('foto.create') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" >
                            Tambah foto
                        </a>

                        <a href="{{ route('albums.index') }}" class="bg-purple-500 hover:bg-green-700 text-white py-2 px-4 rounded" >
                            albums
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">No</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Gambar</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Judul</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Deskripsi</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Tanggal Unggah</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foto as $item)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">
                                    @if ($item->lokasi_file)
                                    <img src="{{ asset('storage/' . $item->lokasi_file) }}" alt="Gambar {{ $item->judul_foto }}" class="w-32 h-32 object-cover rounded">
                                    @else
                                    <img src="{{ asset('images/default-placeholder.jpg') }}" alt="Placeholder" class="w-20 h-20 object-cover rounded">
                                    @endif
                                </td>
                                <td class="py-2 px-4">{{ $item->judul_foto }}</td>
                                <div style="max-width: 300px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis">
                                <td class="py-2 px-4">{{ $item->deskripsi_foto }}</td>
                                </div>
                                <td class="py-2 px-4">{{ $item->tanggal_unggah }}</td>
                                <td class="py-2 px-4 flex space-x-2">

                                    <a href="{{ route('foto.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">Edit</a>
                                    <a href="{{ route('foto.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">Detail</a>
                                    <form action="{{ route('foto.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
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
