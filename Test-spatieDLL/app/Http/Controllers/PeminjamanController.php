<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('user', 'buku')->where('status_peminjaman','Dipinjam')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function admin()
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('operator')) {
            abort(403, 'Unauthorized action.');
        }

        $peminjaman = Peminjaman::with('user', 'buku')
        ->whereIn('status_peminjaman', ['Dipinjam', 'Dikembalikan'])
        ->get();
        return view('admin', compact('peminjaman'));
        
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
            'buku_id' => 'required|exists:buku,id',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->status == 'Dipinjam') {
            return redirect()->back()->with('error', 'Buku sedang dipinjam oleh user lain.');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'tanggal_peminjaman' => now(),
            'status_peminjaman' => 'Dipinjam',
        ]);

        $buku->update(['status' => 'Dipinjam']);

        return redirect()->route('dashboard')->with('success', 'Buku berhasil dipinjam.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = Peminjaman::with('user', 'buku')->findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
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
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'tanggal_pengembalian' => now(),
            'status_peminjaman' => 'Dikembalikan',
        ]);

        $peminjaman->buku->update(['status' => 'tersedia']);

        return redirect()->route('peminjaman.index')->with('success', 'Buku telah dikembalikan.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman dihapus.');
    
    }
}
