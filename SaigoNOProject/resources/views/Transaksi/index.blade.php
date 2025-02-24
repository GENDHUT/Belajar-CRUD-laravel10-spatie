<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex justify-between items-center">
                        <h2 class="text-2xl font-semibold">Daftar Transaksi</h2>
                        <a href="{{ route('transaksi.create') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                            Buat Transaksi Baru
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">No</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Nama Menu</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">User</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Total</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Bayar</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Kembalian</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Status</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-700 dark:text-gray-100 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4">
                                        {{ $item->pesanan->menu->nama_menu ?? 'N/A' }}
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ $item->pesanan->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-2 px-4">{{ $item->total }}</td>
                                    <td class="py-2 px-4">{{ $item->bayar }}</td>
                                    <td class="py-2 px-4">{{ $item->bayar - $item->total }}</td>
                                    <td class="py-2 px-4">{{ $item->pesanan->status }}</td>
                                    <td class="py-2 px-4 flex space-x-2">
                                        <a href="{{ route('transaksi.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">
                                            Detail
                                        </a>

                                        {{-- @if($item->status !== 'Selesai')
                                        <!-- Tombol Edit dan Hapus, bisa disesuaikan kebutuhan -->
                                        <a href="{{ route('transaksi.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">
                                            Edit
                                        </a>
                                        @endif --}}

                                        <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($transaksi->isEmpty())
                                <tr>
                                    <td colspan="8" class="py-4 px-4 text-center text-gray-500 dark:text-gray-400">
                                        Data transaksi belum tersedia.
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
