<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisCokelat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateJenisCokelatController extends Controller
{
    // Menampilkan daftar jenis cokelat
    public function index() {
        $jenisCokelat = JenisCokelat::all();
        return view('admin.jenis_cokelat', compact('jenisCokelat')); // Pastikan view ini ada
    }

    // Menampilkan form untuk menambah jenis cokelat
    public function create() {
        return view('admin.create_jenis'); // Pastikan view ini ada
    }

    // Menyimpan data jenis cokelat
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'jumlah_karakter' => 'nullable|integer|min:0',
        ]);

        $jenisCokelat = new JenisCokelat();

        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoFilename = $fotoFile->getClientOriginalName();
            $fotoFile->move(public_path('uploads'), $fotoFilename);
            $jenisCokelat->foto = 'uploads/' . $fotoFilename;
        }

        $jenisCokelat->nama = $request->nama;
        $jenisCokelat->kategori = $request->kategori;
        $jenisCokelat->harga = $request->harga;
        $jenisCokelat->deskripsi = $request->deskripsi;
        $jenisCokelat->jumlah_karakter = $request->jumlah_karakter;

        $jenisCokelat->save();

        return redirect()->route('admin.jenis_cokelat')->with('success', 'Data berhasil disimpan.');
    }

    // Menampilkan form untuk mengedit jenis cokelat
    public function edit($id) {
        $jenis = JenisCokelat::findOrFail($id);
        return view('admin.edit_jenis', compact('jenis')); // Pastikan view ini ada
    }

    // Memperbarui data jenis cokelat
    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'jumlah_karakter' => 'nullable|integer|min:0',
        ]);

        $jenisCokelat = JenisCokelat::findOrFail($id);

        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoFilename = $fotoFile->getClientOriginalName();
            $fotoFile->move(public_path('uploads'), $fotoFilename);
            $jenisCokelat->foto = 'uploads/' . $fotoFilename;
        }

        $jenisCokelat->nama = $request->nama;
        $jenisCokelat->kategori = $request->kategori;
        $jenisCokelat->harga = $request->harga;
        $jenisCokelat->deskripsi = $request->deskripsi;
        $jenisCokelat->jumlah_karakter = $request->jumlah_karakter;

        $jenisCokelat->save();

        return redirect()->route('admin.jenis_cokelat')->with('success', 'Data berhasil diperbarui.');
    }

    // Menghapus data jenis cokelat
    public function destroy($id){
        $cokelat = JenisCokelat::findOrFail($id);
        $cokelat->delete();

        return redirect()->route('admin.jenis_cokelat')->with('success', 'Jenis Cokelat berhasil dihapus');
    }
}