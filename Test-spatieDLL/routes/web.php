<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UlasanBukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified',])->name('dashboard');

Route::get('/dashboard', [BukuController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/admin', function () {
//     return view('admin');
// })->middleware(['auth', 'verified','role:admin',])->name('admin');

Route::get('/admin', [PeminjamanController::class, 'admin'])->middleware(['auth', 'verified'])->name('admin');




Route::resource('buku', BukuController::class);

Route::resource('koleksi', KoleksiController::class);

Route::resource('ulasan', UlasanBukuController::class);

Route::resource('peminjaman', PeminjamanController::class);


require __DIR__.'/auth.php';
