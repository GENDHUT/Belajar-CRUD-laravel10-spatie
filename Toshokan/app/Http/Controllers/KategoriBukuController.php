<?php

namespace App\Http\Controllers;

use App\Models\KategotiBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategotiBuku::all();
        return view('kategori.index',compact('kategori'));
    }

    // public function kategori()
    // {
    //     $kategori = KategotiBuku::all();
    //     return view('buku.index',compact('kategori'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategotiBuku::all();
        return view('kategori.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|unique:kategoti_bukus,nama_kategori']);
        KategotiBuku::create(['nama_kategori' => $request->nama_kategori]);
        return redirect()->route('buku.index')->with('success', 'Kategori berhasil ditambahkan.');
    
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
        KategotiBuku::findOrFail($id)->delete();
         return redirect()->route('buku.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
