<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex space-x-2">
                        <a href="{{ route('pesanan.create') }}" class="bg-purple-500 hover:bg-purple-700 text-white py-2 px-4 rounded">
                            Tambah Pesanan
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">No</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Pesanan</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">User</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Harga Total</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Status</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $item)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4">{{ $item->menu->nama_menu ?? 'N/A' }}</td>
                                    <td class="py-2 px-4">{{ $item->user->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4">
                                        @if($item->menu)
                                            {{ $item->menu->harga * $item->jumlah }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="py-2 px-4">{{ $item->status ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 flex space-x-2">
                                        @if($item->status !== 'Selesai')
                                            <a href="{{ route('pesanan.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">
                                                Edit
                                            </a>
                                        @endif
                                        <a href="{{ route('pesanan.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">
                                            Detail
                                        </a>
                                        <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
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
