<?php

namespace App\Http\Controllers\User;

use App\Models\Kontak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KontakController extends Controller
{
    // Menampilkan daftar kontak
    public function index() {
        $kontak = Kontak::all();
        return view('user.kontak', compact('kontak')); // Pastikan view ini ada
    }

    // Menampilkan form untuk menambah kontak
    public function create() {
        return view('user.kontak'); // Pastikan view ini ada
    }

    // Menyimpan data kontak
    public function store(Request $request) {
        // Validasi input yang diterima dari form
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'pesan' => 'nullable|string',
        ]);

        $kontak = new Kontak();

        $kontak->nama = $request->nama;
        $kontak->no_telp = $request->no_telp;
        $kontak->email = $request->email;
        $kontak->pesan = $request->pesan;

        $kontak->save();

        return redirect()->route('user.kontak')->with('success', 'Pesan/Masukan berhasil dikirim');
    }
}