<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold mb-4">Detail Transaksi</h2>
                    
                    <div class="mb-2">
                        <strong>Menu:</strong> 
                        {{ $transaksi->pesanan->menu->nama_menu ?? 'N/A' }}
                    </div>
                    
                    <div class="mb-2">
                        <strong>User yang Memesan:</strong>
                        {{ $transaksi->pesanan->user->name ?? 'N/A' }}
                    </div>
                    
                    <div class="mb-2">
                        <strong>Jumlah:</strong>
                        {{ $transaksi->pesanan->jumlah }}
                    </div>
                    
                    <div class="mb-2">
                        <strong>Total:</strong>
                        {{ $transaksi->total }}
                    </div>
                    
                    <div class="mb-2">
                        <strong>Bayar:</strong>
                        {{ $transaksi->bayar }}
                    </div>
                    
                    <div class="mb-2">
                        <strong>Kembalian:</strong>
                        {{ $transaksi->bayar - $transaksi->total }}
                    </div>
                    
                    <div class="mb-2">
                        <strong>Status Pesanan:</strong>
                        {{ $transaksi->pesanan->status }}
                    </div>
                    
                    <a href="{{ route('transaksi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
