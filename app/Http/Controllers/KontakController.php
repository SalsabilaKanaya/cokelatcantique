<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    // Menampilkan daftar jenis cokelat
    public function index() {
        $kontak = Kontak::all();
        return view('kontak', compact('Kontak')); // Pastikan view ini ada
    }

    // Menampilkan form untuk menambah jenis cokelat
    public function create() {
        return view('kontak'); // Pastikan view ini ada
    }

    // Menyimpan data jenis cokelat
    public function store(Request $request) {
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

        return redirect()->route('kontak')->with('success', 'Data berhasil disimpan.');
    }
}