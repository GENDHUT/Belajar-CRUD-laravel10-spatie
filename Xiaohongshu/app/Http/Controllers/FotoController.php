<?php

    namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\FotoComment;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class FotoController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $foto = Foto::where('user_id', Auth::id())->get(); //mengambil user berdasarkan id login
            // $foto = Foto::with('user')->get(); mengambil data user namun tidak memfilter
            // $foto = Foto::all(); -> mengambil semua data user
            // dd($foto->first()->toArray());
            return view('foto.index', compact('foto'));
        }

        public function like($id)
        {
            $foto = Foto::findOrFail($id);
            $user = Auth::user();
    
            // Cek apakah user sudah like
            $existingLike = $foto->likes()->where('user_id', $user->id)->first();
    
            if ($existingLike) {
                // Unlike jika sudah ada
                $existingLike->delete();
                return back()->with('success', 'Like dihapus.');
            } else {
                // Like jika belum ada
                $foto->likes()->create([
                    'user_id' => $user->id,
                ]);
                return back()->with('success', 'Foto disukai.');
            }
        }

        public function comment(Request $request, $id)
        {
            $request->validate([
            'isi_komentar' => 'required|string|max:500',
        ]);

        $foto = Foto::findOrFail($id);

        $foto->comments()->create([
            'user_id' => Auth::id(),
            'isi_komentar' => $request->isi_komentar,
        ]);

            return back()->with('success', 'Komentar berhasil ditambahkan.');
        }

        public function destroyComment($id)
        {
            $comment = FotoComment::findOrFail($id);

            // Pastikan user hanya bisa menghapus komentarnya sendiri
            if ($comment->user_id !== Auth::id()) {
                return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
            }

            $comment->delete();
            return back()->with('success', 'Komentar berhasil dihapus.');
        }

        public function dashboard()
        {
            $foto = Foto::all();
            $album = Album::all();
            return view('dashboard', compact('foto','album'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $album = Album::where('user_id', Auth::id())->get();
            return view('foto.create',compact('album'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            // dd($request->all());
            $request->validate([
                'judul_foto' => ['required','max:255'],
                'deskripsi_foto' => ['nullable'],
                'tanggal_unggah' => ['required','date'],
                'lokasi_file' => ['required','image','mimes:jpg,png,jpeg,gif','max:2048'],
                // 'album_id' => ['required','exists:albums,id']
            ]);

            $filepath = $request->file('lokasi_file')->store('uploads','public');

            if ($request->has('nama_album_baru') && $request->nama_album_baru) {
                $album = Album::create([
                    'nama_album' => $request->nama_album_baru,
                    'user_id' => Auth::id(),
                ]);
                $album_id = $album->id;
            } else {
                $album_id = $request->album_id ? $request->album_id : null;
            }
            
            Foto::create([
                'judul_foto' => $request->judul_foto,
                'deskripsi_foto' => $request->deskripsi_foto,
                'tanggal_unggah' => $request->tanggal_unggah,
                'lokasi_file' => $filepath,
                'album_id' => $album_id,
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('foto.index')->with('success', 'foto berhasil diunggah');
        }

        /**
         * Display the specified resource.
         */
        public function show(Foto $foto)
        {
            return view('foto.show', compact('foto'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Foto $foto)
        {
            return view('foto.edit',compact('foto'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Foto $foto)
        {
            $request->validate([
                'judul_foto' => ['nullable','max:255'],
                'deskripsi_foto' => ['nullable'],
                'tanggal_unggah' => ['required','date'],
                'lokasi_file' => ['nullable','image','mimes:jpg,png,jpeg,gif','max:2048'],
                // 'album_id' => ['required','exists:albums,id']
            ]);

            $data = ([
                'judul_foto' => $request->judul_foto,
                'deskripsi_foto' => $request->deskripsi_foto,
                'tanggal_unggah' => $request->tanggal_unggah,
                // 'lokasi_file' => $request->lokasi_file,
                // 'album_id' => $request->album_id,
            ]);   

            if ($request->hasFile('lokasi_file')){
                $filepath = $request->file('lokasi_file')->store('uploads','public');
                $foto->lokasi_file = $filepath;
            }

            $foto->update($data);                 
            // dd(update());
            return redirect()->route('foto.index')->with('success', 'foto berhasil di edit');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Foto $foto)
        {
            $foto->delete();
            return redirect()->route('foto.index')->with('successs', 'foto berhasil di hapus');
        }
    }
