<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\pelanggan;
use App\Models\penjualan;
use App\Models\produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualans = Penjualan::with('details.produk', 'pelanggan')->get();
        return view('penjualan.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = pelanggan::all();
        $produks    = produk::all();
        return view('penjualan.create', compact('pelanggans', 'produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
            'produk_id'    => 'required|array',
            'produk_id.*'  => 'required|exists:produks,id',
            'jumlah'       => 'required|array',
            'jumlah.*'     => 'required|integer|min:1'
        ]);

        // Buat header penjualan
        $penjualan = Penjualan::create([
            'pelanggan_id'     => $request->pelanggan_id,
            'tanggal_penjualan'=> now(),
            'total_harga'      => 0, // sementara, akan diupdate setelah detail dihitung
        ]);

        $totalHarga = 0;

        // Iterasi setiap item detail
        foreach ($request->produk_id as $index => $produk_id) {
            $jumlah = $request->jumlah[$index];
            $produk = Produk::findOrFail($produk_id);
            $subtotal = $produk->harga * $jumlah;
            $totalHarga += $subtotal;

            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'produk_id'    => $produk_id,
                'jumlah_produk'=> $jumlah,
                'subtotal'     => $subtotal,
            ]);
        }

        // Update total_harga pada header penjualan
        $penjualan->update(['total_harga' => $totalHarga]);

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(penjualan $penjualan)
    {
        $penjualan->load('details.produk', 'pelanggan');
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil dihapus.');
    }
}
