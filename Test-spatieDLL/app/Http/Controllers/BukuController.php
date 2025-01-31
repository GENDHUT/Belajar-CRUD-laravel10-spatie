<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategotiBuku;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class BukuController extends Controller
{
    public function index () {
    $buku = Buku::all();
    $kategori = KategotiBuku::all();
    return view('buku.index', compact('buku','kategori'));

    }

    public function dashboard()
    {
        $buku = Buku::all();
        return view('dashboard', compact('buku'));
    }

    public function create() {
        $kategori = KategotiBuku::all();
        return view('buku.create',compact('kategori'));
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['required', 'string', 'max:255'],
            'tahun_terbit' => ['required', 'integer', 'digits:4', 'min:1000', 'max:' . date('Y')],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'kategori'=> ['exists:kategoti_bukus,id']
        ]);
    
        $data = $request->except('kategori');
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/gambar_buku', $filename); 
            $data['gambar'] = $filename; 
        }
    
        $buku = Buku::create($data); 
        $buku->kategori()->attach($request->kategori);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }
    

    public function show($id){
        $buku = Buku::findOrFail($id);
        return view('buku.detail',compact('buku'));
    }

    public function edit($id) {
        $buku = Buku::findOrFail($id);
        $kategori = KategotiBuku::all();
            return view('buku.edit',compact('buku','kategori'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'judul' => ['nullable', 'string', 'max:255'],
            'penulis' => ['nullable', 'string', 'max:255'],
            'penerbit' => ['nullable', 'string', 'max:255'],
            'tahun_terbit' => ['nullable', 'integer', 'digits:4', 'min:1000', 'max:' . date('Y')],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'kategori' => ['nullable','array'],
            'kategori.*' => ['exists:kategoti_bukus,id'],
        ]);
    
        $buku = Buku::findOrFail($id);
        $data = $request->all();
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/gambar_buku', $filename); 
            $data['gambar'] = $filename; 
        }
    
        $buku->update($data); 
        $buku->kategori()->sync($request->kategori);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }
    

    public Function destroy($id) {
        $buku = buku::findOrFail($id);
        $buku->kategori()->detach();
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }

}
