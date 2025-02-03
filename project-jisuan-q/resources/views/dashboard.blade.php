<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @foreach (auth()->user()->getRoleNames() as $role)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!")  }} {{$role}}
                </div> 
                @endforeach
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form action="{{ route('calculator.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">Angka Pertama:</label>
                            <input type="number" name="a" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white" required>
                        </div>
    
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">Operator:</label>
                            <select name="o" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white" required>
                                <option value="+">+</option>
                                <option value="-">-</option>
                                <option value="*">×</option>
                                <option value="/">÷</option>
                            </select>
                        </div>
    
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">Angka Kedua:</label>
                            <input type="number" name="b" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white" required>
                        </div>
    
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Hitung
                        </button>
                    </form>
    
                    <div class="mt-6 p-4 border rounded bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold">Hasil Perhitungan:</h3>
                        <p class="text-2xl font-bold">
                            {{ session('hasil', 'Belum ada hasil') }}
                        </p>
                    </div>
    
                    @if (session('error'))
                        <div class="mt-6 p-4 bg-red-200 text-red-800 dark:bg-red-700 dark:text-red-200 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
</x-app-layout>
