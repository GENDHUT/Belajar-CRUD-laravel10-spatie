<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h2 class="text-xl font-semibold mb-4">Buat Transaksi Baru</h2>
                    
                    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-4" id="createTransaksiForm">
                        @csrf
                        
                        <!-- Pilih Pesanan (status Proses) -->
                        <div>
                            <label for="pesanan_id" class="block font-medium">Pilih Pesanan</label>
                            <select
                                id="pesanan_id"
                                name="pesanan_id"
                                class="mt-1 block w-full rounded border-gray-300 bg-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                                <option value="">-- Pilih Pesanan --</option>
                                @foreach($pesanan as $item)
                                    @php
                                        $total = $item->menu->harga * $item->jumlah;
                                    @endphp
                                    <option value="{{ $item->id }}" data-total="{{ $total }}">
                                        Pesanan #{{ $item->id }} - {{ $item->menu->nama_menu }} (Total: {{ $total }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pesanan_id')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Total -->
                        <div>
                            <label for="total" class="block font-medium">Total</label>
                            <input
                                type="number"
                                name="total"
                                id="total"
                                class="mt-1 block w-full rounded border-gray-300 bg-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan total"
                                required
                            >
                            @error('total')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Bayar -->
                        <div>
                            <label for="bayar" class="block font-medium ">Bayar</label>
                            <input
                                type="number"
                                name="bayar"
                                id="bayar"
                                class="mt-1 block w-full rounded border-gray-300 bg-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Jumlah uang yang dibayar"
                                required
                            >
                            @error('bayar')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status (otomatis, read-only) -->
                        <div>
                            <label for="status" class="block font-medium">Status</label>
                            <input
                                type="text"
                                id="status"
                                name="status_display"
                                value="Proses"
                                readonly
                                class="mt-1 block w-full rounded border-gray-300 bg-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500"
                            >
                            <!-- Hidden input untuk mengirim status ke server -->
                            <input type="hidden" name="status" id="status_hidden" value="Proses">
                        </div>
                        
                        <button
                            type="submit"
                            class="mt-2 bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded"
                        >
                            Simpan
                        </button>
                        <a href="{{ route('transaksi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Script untuk mengupdate status berdasarkan perbandingan total dan bayar -->
    <script>
        function updateStatus() {
            var total = parseFloat(document.getElementById('total').value) || 0;
            var bayar = parseFloat(document.getElementById('bayar').value) || 0;
            
            var statusDisplay = document.getElementById('status');
            var statusHidden = document.getElementById('status_hidden');
            
            if (bayar >= total && total > 0) {
                statusDisplay.value = "Selesai";
                statusHidden.value = "Selesai";
            } else {
                statusDisplay.value = "Proses";
                statusHidden.value = "Proses";
            }
        }
        
        // Saat pesanan dipilih, set nilai total berdasarkan data-total
        document.getElementById('pesanan_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var dataTotal = selectedOption.getAttribute('data-total');
            if(dataTotal) {
                document.getElementById('total').value = dataTotal;
            }
            updateStatus();
        });
        
        document.getElementById('total').addEventListener('input', updateStatus);
        document.getElementById('bayar').addEventListener('input', updateStatus);
    </script>
</x-app-layout>
