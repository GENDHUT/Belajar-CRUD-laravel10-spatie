<?php

namespace App\Http\Controllers;

use App\Models\koleksi;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $koleksi = koleksi::where('user_id', auth()->id())->with('buku')->get();
        return view('koleksi.index', compact('koleksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'buku_id' => ['required', 'exists:buku,id'],
    ]);

    $exists = koleksi::where('user_id', auth()->id())
                     ->where('buku_id', $request->buku_id)
                     ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Buku sudah ada di koleksi Anda.');
    }

    koleksi::create([
        'user_id' => auth()->id(),
        'buku_id' => $request->buku_id,
    ]);

    return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke koleksi.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $koleksi = koleksi::where('user_id',auth()->id())->findOrFail($id);
        $koleksi->delete();

        return redirect()->back()->with('Success','Buku anda berhasil di hapus.');
    }
}
