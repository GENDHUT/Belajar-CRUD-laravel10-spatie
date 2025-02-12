<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Daftar Produk</h2>
                    <div class="mb-4">
                        <a href="{{ route('produk.create') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                            Tambah Produk
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">No</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Nama Produk</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Harga</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Stok</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($produk as $item)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4">{{ $item->nama_produk }}</td>
                                    <td class="py-2 px-4">Rp {{ number_format($item->harga, 2) }}</td>
                                    <td class="py-2 px-4">{{ $item->stok }}</td>
                                    <td class="py-2 px-4 flex space-x-2">
                                        {{-- <a href="{{ route('produk.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">
                                            Detail
                                        </a> --}}
                                        <a href="{{ route('produk.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">
                                            Edit
                                        </a>
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($produk->isEmpty())
                                <tr>
                                    <td colspan="5" class="py-2 px-4 text-center text-gray-500">
                                        Tidak ada data produk.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
