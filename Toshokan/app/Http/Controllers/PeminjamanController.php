<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


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

    public function admin(User $user)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('operator')) {
            abort(403, 'Unauthorized action.');
        }


        $peminjaman = Peminjaman::with('user', 'buku')
        ->whereIn('status_peminjaman', ['Dipinjam', 'Dikembalikan'])
        ->get();
        $users = User::all();

        return view('admin', compact('peminjaman','users'));
        
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
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('Users.edit',compact('user','roles'));
    }
    // public function edit(User $user)
    // {
       
    // }
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

    public function role(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required','string','max:225'],
            'role' => ['required','string','in:admin,operator,peminjam']

        ]);

        $user->name = $request->input('name');
        $user->save();

        $user->syncRoles($request->input('role'));
        return redirect()->route('admin')->with('susccess','Role Berhasil di Rubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $peminjaman = Peminjaman::findOrFail($id);
        // $peminjaman->delete();

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin')->with('success', 'User Berhasil dihapus.');
    
    }

    // public function user(string $id)
    // {   
    //     $user = User::findOrFail($id);
    //     $user->delete();

    //     return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman dihapus.');
    
    // }

}
