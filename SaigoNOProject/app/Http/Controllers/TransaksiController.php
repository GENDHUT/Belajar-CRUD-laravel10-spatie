<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with('pesanan.menu', 'pesanan.user')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pesanan = Pesanan::where('status', 'Proses')->get();
        return view('transaksi.create', compact('pesanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pesanan_id' => 'required|exists:pesanans,id',
            'total'      => 'required|integer|min:0',
            'bayar'      => 'required|integer|min:0',
        ]);

        // Buat transaksi baru
        $transaksi = Transaksi::create($validatedData);

        // Jika pembayaran mencukupi, update status pesanan menjadi "Selesai"
        $pesanan = Pesanan::find($validatedData['pesanan_id']);
        if ($validatedData['bayar'] >= $validatedData['total'] && $validatedData['total'] > 0) {
            $pesanan->update(['status' => 'Selesai']);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load('pesanan.menu', 'pesanan.user');
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
