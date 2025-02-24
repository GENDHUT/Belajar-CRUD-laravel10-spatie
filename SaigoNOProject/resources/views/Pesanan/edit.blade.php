<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Edit Pesanan</h2>
        
                    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" class="space-y-6" id="editPesananForm">
                        @csrf
                        @method('PUT')
        
                        <!-- Pilih Menu -->
                        <div>
                            <label for="menu_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Menu</label>
                            <select id="menu_id" name="menu_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">-- Pilih Menu --</option>
                                @foreach ($menu as $item)
                                    <option value="{{ $item->id }}" data-harga="{{ $item->harga }}"
                                        @if($pesanan->menu_id == $item->id) selected @endif>
                                        {{ $item->nama_menu }}
                                    </option>
                                @endforeach
                            </select>
                            @error('menu_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Jumlah Pesanan -->
                        <div>
                            <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Pesanan</label>
                            <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $pesanan->jumlah) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('jumlah')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Pilihan User Berdasarkan Role -->
                        @if(auth()->user()->hasAnyRole(['admin', 'waiter']))
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih User</label>
                                <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">-- Pilih User --</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}"
                                            @if($pesanan->user_id == $u->id) selected @endif>
                                            {{ $u->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                                <input type="text" id="user_id_display" value="{{ auth()->user()->id }}" readonly
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @error('user_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
        
                        <!-- Bayar -->
                        <div>
                            <label for="bayar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bayar</label>
                            <input type="number" id="bayar" name="bayar" value="{{ old('bayar') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('bayar')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Display Harga Total dan Kembalian -->
                        <div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                Harga Total: <span id="hargaTotal">0</span>
                            </p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                Kembalian: <span id="kembalian">0</span>
                            </p>
                        </div>
        
                        <!-- Status (otomatis, read-only) -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <input type="text" id="status" name="status_display" value="{{ $pesanan->status }}" readonly
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-200 dark:text-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <!-- Hidden field untuk mengirim status ke server -->
                            <input type="hidden" name="status" id="status_hidden" value="{{ $pesanan->status }}">
                        </div>
        
                        <!-- Tombol Aksi -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('pesanan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded" id="submitBtn">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Script JavaScript untuk menghitung harga total, kembalian, dan mengubah status serta popup konfirmasi saat submit -->
    <script>
        function hitungHarga() {
            var menuSelect = document.getElementById('menu_id');
            var jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
            var bayar = parseFloat(document.getElementById('bayar').value) || 0;
            
            // Ambil harga dari opsi yang dipilih (data-harga)
            var harga = 0;
            if(menuSelect.selectedIndex > 0) {
                var selectedOption = menuSelect.options[menuSelect.selectedIndex];
                harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            }
            
            // Hitung total harga
            var total = harga * jumlah;
            document.getElementById('hargaTotal').innerText = total;
            
            // Hitung kembalian
            var kembalian = bayar - total;
            document.getElementById('kembalian').innerText = kembalian;
            
            // Update status: jika bayar cukup, status menjadi "Selesai", jika tidak, "Proses"
            var statusField = document.getElementById('status');
            var statusHidden = document.getElementById('status_hidden');
            if(bayar >= total && total > 0) {
                statusField.value = "Selesai";
                statusHidden.value = "Selesai";
            } else {
                statusField.value = "Proses";
                statusHidden.value = "Proses";
            }
        }
        
        // Panggil hitungHarga saat input berubah
        document.getElementById('menu_id').addEventListener('change', hitungHarga);
        document.getElementById('jumlah').addEventListener('input', hitungHarga);
        document.getElementById('bayar').addEventListener('input', hitungHarga);
        
        // Panggil sekali saat halaman dimuat
        hitungHarga();
        
        // Tambahkan event listener submit untuk menampilkan popup konfirmasi berisi kembalian
        document.getElementById('editPesananForm').addEventListener('submit', function(e) {
            var kembalian = document.getElementById('kembalian').innerText;
            var confirmMsg = "Kembalian: " + kembalian + ". Terimakasih!!";
            if(!confirm(confirmMsg)) {
                e.preventDefault();
            }
        });
    </script>
</x-app-layout>
