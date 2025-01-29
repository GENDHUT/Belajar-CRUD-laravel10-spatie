<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\UlasanBuku;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UlasanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ulasan = UlasanBuku::with('buku', 'user')->latest()->get();
        return view('ulasan.index', compact('ulasan'));
        
    }

    public function ulasan($buku_id)
    {
        $buku = Buku::with('ulasan.user')->findOrFail($buku_id); 
        return view('buku.detail', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $buku_id = $request->query('buku_id'); 
        $buku = Buku::find($buku_id); 
        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan!');
        }

        return view('ulasan.create', compact('buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => ['required', 'exists:buku,id'],
            'ulasan' => ['required', 'string', 'min:10'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        UlasanBuku::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
            'ulasan' => $request->ulasan,
            'rating' => $request->rating,
        ]);

        return redirect()->route('dashboard')->with('success', 'Ulasan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ulasan = UlasanBuku::with('buku', 'user')->findOrFail($id);
        return view('ulasan.show', compact('ulasan'));    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ulasan = UlasanBuku::findOrFail($id);

        if ($ulasan->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak berhak mengedit ulasan ini!');
        }

        return view('ulasan.edit', compact('ulasan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ulasan = UlasanBuku::findOrFail($id);

        if ($ulasan->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak berhak mengedit ulasan ini!');
        }

        $request->validate([
            'ulasan' => ['required', 'string', 'min:10'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $ulasan->update([
            'ulasan' => $request->ulasan,
            'rating' => $request->rating,
        ]);

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ulasan = UlasanBuku::findOrFail($id);

        if ($ulasan->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak berhak menghapus ulasan ini!');
        }

        $ulasan->delete();
        return redirect()->route('dahboard')->with('success', 'Ulasan berhasil dihapus!');
    }
}
