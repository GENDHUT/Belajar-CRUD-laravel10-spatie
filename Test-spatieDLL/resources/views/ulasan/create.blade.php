<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Beri Ulasan untuk "{{ $buku->judul }}"</h2>
                    <!-- Gambar Buku -->
                    @if ($buku->gambar)
                        <img src="{{ asset('storage/gambar_buku/' . $buku->gambar) }}" 
                             alt="Gambar {{ $buku->judul }}" 
                             class="w-24 h-32 object-cover rounded-md shadow-md mb-4">
                    @endif
                    <form action="{{ route('ulasan.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                        <!-- Ulasan -->
                        <div>
                            <label for="ulasan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ulasan</label>
                            <textarea id="ulasan" name="ulasan" rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('ulasan') }}</textarea>
                            @error('ulasan')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating</label>
                            <select id="rating" name="rating"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Rating</option>
                                <option value="1">1 - Sangat Buruk</option>
                                <option value="2">2 - Buruk</option>
                                <option value="3">3 - Biasa</option>
                                <option value="4">4 - Baik</option>
                                <option value="5">5 - Sangat Baik</option>
                            </select>
                            @error('rating')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('buku.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
