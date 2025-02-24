<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [PesananController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// ->middleware(['auth', 'verified','role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('menu', MenuController::class)->middleware(['auth', 'verified','role:admin']);
Route::resource('pesanan', PesananController::class);
Route::resource('transaksi', TransaksiController::class)->middleware(['auth', 'verified','role:admin']);
Route::resource('user', UserController::class)->middleware(['auth', 'verified','role:admin']);

require __DIR__.'/auth.php';
