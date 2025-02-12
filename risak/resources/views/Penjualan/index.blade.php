<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Daftar Penjualan</h2>
                    <div class="mb-4">
                        <a href="{{ route('penjualan.create') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                            Tambah Penjualan
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="py-2 px-4">No</th>
                                <th class="py-2 px-4">Tanggal & Waktu</th>
                                <th class="py-2 px-4">Total Harga</th>
                                <th class="py-2 px-4">Pembeli</th>
                                <th class="py-2 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($penjualans as $penjualan)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4">{{ $penjualan->tanggal_penjualan }}</td>
                                    <td class="py-2 px-4">Rp {{ number_format($penjualan->total_harga, 2) }}</td>
                                    <td class="py-2 px-4">
                                        {{ $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Umum' }}
                                    </td>
                                    <td class="py-2 px-4 flex space-x-2">
                                        <a href="{{ route('penjualan.show', $penjualan->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">
                                            Detail
                                        </a>
                                        <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus penjualan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($penjualans->isEmpty())
                                <tr>
                                    <td colspan="5" class="py-2 px-4 text-center text-gray-500">
                                        Tidak ada data penjualan.
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
