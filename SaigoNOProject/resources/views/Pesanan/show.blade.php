<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Detail Pesanan</h2>
                    
                    <!-- Nama Menu Pesanan -->
                    <div class="mb-4">
                        <strong>Nama Menu Pesanan:</strong>
                        <span>{{ $pesanan->menu->nama_menu ?? 'N/A' }}</span>
                    </div>
                    
                    <!-- User yang Memesan -->
                    <div class="mb-4">
                        <strong>User yang Memesan:</strong>
                        <span>{{ $pesanan->user->name ?? 'N/A' }}</span>
                    </div>
                    
                    <!-- User yang Melayani (nama user + role) -->
                    <div class="mb-4">
                        <strong>User yang Melayani:</strong>
                        <span>
                            {{ $pesanan->user->name ?? 'N/A' }},
                            <strong>Role User:</strong>
                            @if($pesanan->user)
                                ({{ implode(', ', $pesanan->user->getRoleNames()->toArray()) }})
                            @endif
                        </span>
                    </div>
                    
                    <!-- Harga Menu -->
                    <div class="mb-4">
                        <strong>Harga Menu:</strong>
                        <span>{{ $pesanan->menu->harga ?? 'N/A' }}</span>
                    </div>
                    
                    <!-- Jumlah Pesanan -->
                    <div class="mb-4">
                        <strong>Jumlah Pesanan:</strong>
                        <span>{{ $pesanan->jumlah }}</span>
                    </div>
                    
                    <!-- Total Harga (Harga Menu x Jumlah Pesanan) -->
                    <div class="mb-4">
                        <strong>Total Harga:</strong>
                        <span>
                            @if($pesanan->menu)
                                {{ $pesanan->menu->harga * $pesanan->jumlah }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    
                    <!-- Status Pesanan -->
                    <div class="mb-4">
                        <strong>Status:</strong>
                        <span>{{ $pesanan->status }}</span>
                    </div>
                    
                    <!-- Tombol Kembali -->
                    <div class="flex space-x-4">
                        <a href="{{ route('pesanan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
