<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::with(['menu', 'user'])->get();
        return view('pesanan.index', compact('pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = Menu::all();
        $user = User::all();
        return view('pesanan.create', compact('menu', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'user_id' => 'required|exists:users,id',
            'jumlah'  => 'required|string'
        ]);

        Pesanan::create($validatedData);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan, $id)
    {
        $pesanan = Pesanan::with(['menu', 'user'])->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $menu = Menu::all();
        $user = User::all();
        return view('pesanan.edit', compact('pesanan', 'menu', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan, $id)
    {
        $validatedData = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'user_id' => 'required|exists:users,id',
            'jumlah'  => 'required|string'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($validatedData);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        // $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
