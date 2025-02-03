<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $album = Album::where('user_id', Auth::id())->get();
        return view('albums.index', compact('album'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil foto yang belum terikat pada album
        $foto = Foto::where('user_id', Auth::id())
                    ->whereNull('album_id')
                    ->get();

        return view('albums.create', compact('foto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_album' => ['required', 'string', 'max:255'],
            'deskripsi'   => ['nullable', 'string'],
            'foto_id'     => ['required', 'array'],         // Minimal harus ada satu foto yang dipilih
            'foto_id.*'   => ['exists:fotos,id'],
        ]);

        // Buat album baru
        $album = Album::create([
            'nama_album' => $request->nama_album,
            'deskripsi'  => $request->deskripsi,
            'user_id'    => Auth::id(),
        ]);

        // Update setiap foto yang dipilih agar terikat ke album baru
        foreach ($request->foto_id as $foto_id) {
            $foto = Foto::findOrFail($foto_id);
            $foto->update(['album_id' => $album->id]);
        }

        return redirect()->route('albums.index')->with('success', 'Album berhasil dibuat dan foto berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        // Pastikan album yang ditampilkan milik user yang sedang login
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        // Eager load foto terkait
        $album->load('foto');

        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
        ]);

        $album->update($request->only(['nama_album', 'deskripsi']));

        return redirect()->route('albums.index')->with('success', 'Album berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album berhasil dihapus!');
    }
}
