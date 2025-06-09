<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Alert;
use App\Models\Kandang;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(User $pengguna)
    {
        $kandang = Kandang::get();
        return view('users.tambah', compact('pengguna', 'kandang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasi inputan
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'level' => 'required',
        ]);

        if ($request->level === 'PETERNAK') {
            $rules['kandang_id'] = 'required';
        }
        // insert data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'kandang_id' => $request->level === 'PETERNAK' ? $request->kandang_id : null,
        ]);
        Alert::success('Sukses', 'Berhasil Menambahkan User Baru');
        return redirect()->route('pengguna.index');
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
    public function edit(User $pengguna)
    {

        $kandang = Kandang::all();
        return view('users.edit', compact('pengguna', 'kandang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pengguna->id,
            'password' => 'nullable|min:6',
            'level' => 'required|string',
            // 'kandang_id' => 'required|exists:kandang_id,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'kandang_id' => $request->kandang_id,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        Alert::success('Sukses', 'Berhasil Mengupdate Pengguna');
        return redirect()->route('pengguna.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        $pengguna->destroy($pengguna->id);
        Alert::success('Sukses', 'Berhasil Menghapus Pengguna');
        return redirect()->route('pengguna.index');
    }
}
