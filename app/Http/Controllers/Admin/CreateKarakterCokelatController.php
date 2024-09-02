<?php

namespace App\Http\Controllers\Admin;

use App\Models\KarakterCokelat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateKarakterCokelatController extends Controller
{
    // Menampilkan daftar karakter cokelat
    public function index() {
        $karakterCokelat = KarakterCokelat::orderBy('created_at', 'desc')->paginate(6); // Mengambil semua data karakter cokelat
        return view('admin.karakter_cokelat', compact('karakterCokelat')); // Mengarahkan ke view karakter_cokelat.blade.php
    }

    // Menampilkan form untuk menambah karakter cokelat
    public function create() {
        return view('admin.create_karakter'); // Mengarahkan ke view create_karakter.blade.php
    }

    // Menyimpan data karakter cokelat
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image',
            'kategori' => 'required',
            'deskripsi' => 'nullable|string',
        ]);

        $karakterCokelat = new KarakterCokelat(); // Inisialisasi model KarakterCokelat

        // Jika ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoFilename = $fotoFile->getClientOriginalName(); // Mendapatkan nama file asli
            $fotoFile->move(public_path('uploads'), $fotoFilename); // Memindahkan file ke direktori uploads
            $karakterCokelat->foto = 'uploads/' . $fotoFilename; // Menyimpan path foto ke model
        }

        $karakterCokelat->nama = $request->nama; // Menyimpan nama karakter cokelat
        $karakterCokelat->kategori = $request->kategori; // Menyimpan kategori
        $karakterCokelat->deskripsi = $request->deskripsi; // Menyimpan deskripsi

        $karakterCokelat->save(); // Menyimpan data ke database

        return redirect()->route('admin.karakter_cokelat')->with('success', 'Data berhasil disimpan.'); // Mengarahkan kembali dengan pesan sukses
    }

    // Menampilkan form untuk mengedit karakter cokelat
    public function edit($id) {
        $karakter = KarakterCokelat::findOrFail($id); // Mencari karakter cokelat berdasarkan ID
        return view('admin.edit_karakter', compact('karakter')); // Mengarahkan ke view edit_karakter.blade.php
    }

    // Memperbarui data karakter cokelat
    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image',
            'kategori' => 'required',
            'deskripsi' => 'nullable|string',
        ]);

        $karakterCokelat = KarakterCokelat::findOrFail($id); // Mencari karakter cokelat berdasarkan ID

        // Jika ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoFilename = $fotoFile->getClientOriginalName(); // Mendapatkan nama file asli
            $fotoFile->move(public_path('uploads'), $fotoFilename); // Memindahkan file ke direktori uploads
            $karakterCokelat->foto = 'uploads/' . $fotoFilename; // Menyimpan path foto ke model
        }

        $karakterCokelat->nama = $request->nama; // Memperbarui nama karakter cokelat
        $karakterCokelat->kategori = $request->kategori; // Memperbarui kategori
        $karakterCokelat->deskripsi = $request->deskripsi; // Memperbarui deskripsi

        $karakterCokelat->save(); // Menyimpan perubahan ke database

        return redirect()->route('admin.karakter_cokelat')->with('success', 'Data berhasil diperbarui.'); // Mengarahkan kembali dengan pesan sukses
    }

    // Menghapus data karakter cokelat
    public function destroy($id){
        $cokelat = KarakterCokelat::findOrFail($id); // Mencari karakter cokelat berdasarkan ID
        $cokelat->delete(); // Menghapus data dari database

        return redirect()->route('admin.karakter_cokelat')->with('success', 'Karakter Cokelat berhasil dihapus'); // Mengarahkan kembali dengan pesan sukses
    }
}
