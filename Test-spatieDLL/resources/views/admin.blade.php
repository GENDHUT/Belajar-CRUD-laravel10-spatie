<x-app-layout>
    <!-- Bagian Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Tabel Peminjaman -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Daftar Peminjaman</h3>

                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">#</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nama User</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Judul Buku</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tanggal Peminjaman</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tanggal Pengembalian</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Status</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjaman as $item)
                                <tr class="border border-gray-300 dark:border-gray-600">
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $item->user->name }}</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $item->buku->judul }}</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $item->tanggal_peminjaman }}</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                        {{ $item->tanggal_pengembalian ?? 'Belum Dikembalikan' }}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                        <span class="px-2 py-1 rounded text-white 
                                            {{ $item->status_peminjaman == 'Dipinjam' ? 'bg-red-500' : 'bg-green-500' }} ">
                                            {{ $item->status_peminjaman }}
                                        </span>
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                        @if ($item->status_peminjaman == 'Dipinjam')
                                            <form action="{{ route('peminjaman.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">✔ Dikembalikan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($peminjaman->isEmpty())
                        <p class="text-center text-gray-500 mt-4">Tidak ada peminjaman.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Pengguna -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Daftar Pengguna</h3>

                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">#</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nama</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Email</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Role</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border border-gray-300 dark:border-gray-600">
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $user->name }}</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $user->email }}</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                        @foreach ($user->roles as $role)
                                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-200">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('users.edit', $user) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded">
                                                Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($users->isEmpty())
                        <p class="text-center text-gray-500 mt-4">Tidak ada pengguna.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
