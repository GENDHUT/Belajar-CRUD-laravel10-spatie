<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Detail Penjualan</h2>
                    <div class="mb-4">
                        <strong>Tanggal Penjualan:</strong> {{ $penjualan->tanggal_penjualan }}
                    </div>
                    <div class="mb-4">
                        <strong>Total Harga:</strong> Rp {{ number_format($penjualan->total_harga, 2) }}
                    </div>
                    <div class="mb-4">
                        <strong>Pelanggan:</strong> {{ $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Umum' }}
                    </div>
                    <h3 class="text-xl font-semibold mt-6">Detail Barang</h3>
                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="py-2 px-4">No</th>
                                <th class="py-2 px-4">Produk</th>
                                <th class="py-2 px-4">Harga Satuan</th>
                                <th class="py-2 px-4">Jumlah</th>
                                <th class="py-2 px-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($penjualan->details as $index => $detail)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-2 px-4">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4">{{ $detail->produk->nama_produk }}</td>
                                    <td class="py-2 px-4">Rp {{ number_format($detail->produk->harga, 2) }}</td>
                                    <td class="py-2 px-4">{{ $detail->jumlah_produk }}</td>
                                    <td class="py-2 px-4">Rp {{ number_format($detail->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <a href="{{ route('penjualan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
