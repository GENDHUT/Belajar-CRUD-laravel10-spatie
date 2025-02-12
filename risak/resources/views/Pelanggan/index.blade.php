<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex space-x-2">
                        <a href="{{ route('pelanggan.create') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                            Tambah Pelanggan
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">No</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Nama Pelanggan</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Alamat</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Nomor Telepon</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggan as $item)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $item->nama_pelanggan }}</td>
                                <td class="py-2 px-4">{{ $item->alamat }}</td>
                                <td class="py-2 px-4">{{ $item->nomor_telepon }}</td>
                                <td class="py-2 px-4 flex space-x-2">
                                    {{-- <a href="{{ route('pelanggan.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">
                                        Detail
                                    </a> --}}
                                    <a href="{{ route('pelanggan.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">
                                            Hapus
                                        </button>
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
