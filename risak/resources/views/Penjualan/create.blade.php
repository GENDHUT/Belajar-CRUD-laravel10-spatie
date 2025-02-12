<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4 text-gray-500">Tambah Penjualan</h2>
                    <form method="POST" action="{{ route('penjualan.store') }}">
                        @csrf
                        
                        <!-- Pilih Pelanggan (Opsional) -->
                        <div class="mb-4">
                            <x-input-label for="pelanggan_id" class="text-gray-500" :value="__('Pelanggan (Opsional)')" />
                            <select name="pelanggan_id" id="pelanggan_id" class="block mt-1 w-full text-gray-500">
                                <option value="">Pilih Pelanggan</option>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('pelanggan_id')" class="mt-2" />
                        </div>
                        
                        <!-- Detail Penjualan -->
                        <div class="mb-4">
                            <x-input-label class="text-gray-500" :value="__('Detail Penjualan')" />
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 text-gray-500">Produk</th>
                                        <th class="py-2 px-4 text-gray-500">Jumlah</th>
                                        <th class="py-2 px-4 text-gray-500">Subtotal</th>
                                        <th class="py-2 px-4 text-gray-500">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-rows">
                                    <tr class="detail-row">
                                        <td>
                                            <select name="produk_id[]" class="block mt-1 w-full product-select text-gray-500">
                                                <option value="">Pilih Produk</option>
                                                @foreach($produks as $produk)
                                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">
                                                        {{ $produk->nama_produk }} - Rp {{ number_format($produk->harga,2) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah[]" class="block mt-1 w-full quantity-input text-gray-500" value="1" min="1">
                                        </td>
                                        <td>
                                            <input type="text" name="subtotal[]" class="block mt-1 w-full subtotal-input text-gray-500" readonly value="0.00">
                                        </td>
                                        <td>
                                            <button type="button" class="remove-row bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" id="add-row" class="mt-2 bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded">
                                Tambah Baris
                            </button>
                        </div>
                        
                        <!-- Total Harga -->
                        <div class="mb-4">
                            <x-input-label for="total_harga" class="text-gray-500" :value="__('Total Harga')" />
                            <input type="text" id="total_harga" name="total_harga" class="block mt-1 w-full text-gray-500" readonly value="0.00">
                        </div>
                        
                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('penjualan.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                Batal
                            </a>
                            <x-primary-button class="ml-4">
                                Simpan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk penambahan baris dan kalkulasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateSubtotal(row) {
                var productSelect = row.querySelector('.product-select');
                var quantityInput = row.querySelector('.quantity-input');
                var subtotalInput = row.querySelector('.subtotal-input');
                
                var harga = parseFloat(productSelect.options[productSelect.selectedIndex].getAttribute('data-harga')) || 0;
                var jumlah = parseInt(quantityInput.value) || 0;
                var subtotal = harga * jumlah;
                subtotalInput.value = subtotal.toFixed(2);
            }
            
            function updateTotal() {
                var total = 0;
                document.querySelectorAll('.subtotal-input').forEach(function(input) {
                    total += parseFloat(input.value) || 0;
                });
                document.getElementById('total_harga').value = total.toFixed(2);
            }
            
            // Event listener untuk perubahan produk atau jumlah
            document.getElementById('detail-rows').addEventListener('change', function(e) {
                if (e.target.classList.contains('product-select') || e.target.classList.contains('quantity-input')) {
                    var row = e.target.closest('.detail-row');
                    updateSubtotal(row);
                    updateTotal();
                }
            });
            
            // Tambah baris baru
            document.getElementById('add-row').addEventListener('click', function() {
                var newRow = document.querySelector('.detail-row').cloneNode(true);
                newRow.querySelector('.product-select').selectedIndex = 0;
                newRow.querySelector('.quantity-input').value = 1;
                newRow.querySelector('.subtotal-input').value = '0.00';
                document.getElementById('detail-rows').appendChild(newRow);
            });
            
            // Hapus baris (minimal 1 baris)
            document.getElementById('detail-rows').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-row')) {
                    if (document.querySelectorAll('.detail-row').length > 1) {
                        e.target.closest('.detail-row').remove();
                        updateTotal();
                    } else {
                        alert('Minimal satu baris detail harus ada.');
                    }
                }
            });
            
            // Kalkulasi awal
            document.querySelectorAll('.detail-row').forEach(function(row) {
                updateSubtotal(row);
            });
            updateTotal();
        });
    </script>
</x-app-layout>
