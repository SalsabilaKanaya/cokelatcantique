<?php

namespace App\Http\Controllers\Admin;

use App\Models\KarakterCokelat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateKarakterCokelatController extends Controller
{
    // Menampilkan daftar Karakter cokelat
    public function index() {
        $karakterCokelat = KarakterCokelat::all();
        return view('admin.karakter_cokelat', compact('karakterCokelat')); // Pastikan view ini ada
    }

    // Menampilkan form untuk menambah karakter cokelat
    public function create() {
        return view('admin.create_karakter'); // Pastikan view ini ada
    }

    // Menyimpan data karakter cokelat
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image',
            'kategori' => 'required',
            'deskripsi' => 'nullable|string',
        ]);

        $karakterCokelat = new KarakterCokelat(); // Inisialisasi model

        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoFilename = $fotoFile->getClientOriginalName();
            $fotoFile->move(public_path('uploads'), $fotoFilename);
            $karakterCokelat->foto = 'uploads/' . $fotoFilename; // Simpan ke database
        }

        $karakterCokelat->nama = $request->nama; // Menyimpan nama
        $karakterCokelat->kategori = $request->kategori; // Menyimpan kategori
        $karakterCokelat->deskripsi = $request->deskripsi; // Menyimpan deskripsi

        $karakterCokelat->save(); // Simpan model ke database

        return redirect()->route('admin.karakter_cokelat')->with('success', 'Data berhasil disimpan.');
    }

    // Menampilkan form untuk mengedit karakter cokelat
    public function edit($id) {
        $karakter = KarakterCokelat::findOrFail($id);
        return view('admin.edit_karakter', compact('karakter')); // Pastikan view ini ada
    }

    // Memperbarui data karakter cokelat
    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image',
            'kategori' => 'required',
            'deskripsi' => 'nullable|string',
        ]);

        $karakterCokelat = KarakterCokelat::findOrFail($id); // Temukan model berdasarkan ID

        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoFilename = $fotoFile->getClientOriginalName();
            $fotoFile->move(public_path('uploads'), $fotoFilename);
            $karakterCokelat->foto = 'uploads/' . $fotoFilename; // Simpan ke database
        }

        $karakterCokelat->nama = $request->nama; // Menyimpan nama
        $karakterCokelat->kategori = $request->kategori; // Menyimpan kategori
        $karakterCokelat->deskripsi = $request->deskripsi; // Menyimpan deskripsi

        $karakterCokelat->save(); // Simpan model ke database

        return redirect()->route('admin.karakter_cokelat')->with('success', 'Data berhasil diperbarui.');
    }

    // Menghapus data karakter cokelat
    public function destroy($id){
        $cokelat = KarakterCokelat::findOrFail($id);
        $cokelat->delete();

        return redirect()->route('admin.karakter_cokelat')->with('success', 'Karakter Cokelat berhasil dihapus');
    }
}
