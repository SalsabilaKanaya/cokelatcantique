<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisCokelat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateJenisCokelatController extends Controller
{
    // Menampilkan daftar jenis cokelat
    public function index() {
        $jenisCokelat = JenisCokelat::orderBy('created_at', 'desc')->paginate(6); // Mengambil data jenis cokelat dengan pagination dan urutan terbaru // Mengambil semua data jenis cokelat
        return view('admin.jenis_cokelat', compact('jenisCokelat')); // Mengarahkan ke view jenis_cokelat.blade.php
    }

    // Menampilkan form untuk menambah jenis cokelat
    public function create() {
        return view('admin.create_jenis'); // Mengarahkan ke view create_jenis.blade.php
    }

    // Menyimpan data jenis cokelat
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|image',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'jumlah_karakter' => 'nullable|integer|min:0',
        ]);

        $jenisCokelat = new JenisCokelat(); // Inisialisasi model JenisCokelat

        // Jika ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoFilename = $fotoFile->getClientOriginalName(); // Mendapatkan nama file asli
            $fotoFile->move(public_path('uploads'), $fotoFilename); // Memindahkan file ke direktori uploads
            $jenisCokelat->foto = 'uploads/' . $fotoFilename; // Menyimpan path foto ke model
        }

        $jenisCokelat->nama = $request->nama; // Menyimpan nama jenis cokelat
        $jenisCokelat->kategori = $request->kategori; // Menyimpan kategori
        $jenisCokelat->harga = $request->harga; // Menyimpan harga
        $jenisCokelat->deskripsi = $request->deskripsi; // Menyimpan deskripsi
        $jenisCokelat->jumlah_karakter = $request->jumlah_karakter; // Menyimpan jumlah karakter

        $jenisCokelat->save(); // Menyimpan data ke database

        return redirect()->route('admin.jenis_cokelat')->with('success', 'Data berhasil disimpan.'); // Mengarahkan kembali dengan pesan sukses
    }

    // Menampilkan form untuk mengedit jenis cokelat
    public function edit($id) {
        $jenis = JenisCokelat::findOrFail($id); // Mencari jenis cokelat berdasarkan ID
        return view('admin.edit_jenis', compact('jenis')); // Mengarahkan ke view edit_jenis.blade.php
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

        $jenisCokelat = JenisCokelat::findOrFail($id); // Mencari jenis cokelat berdasarkan ID

        // Jika ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoFilename = $fotoFile->getClientOriginalName(); // Mendapatkan nama file asli
            $fotoFile->move(public_path('uploads'), $fotoFilename); // Memindahkan file ke direktori uploads
            $jenisCokelat->foto = 'uploads/' . $fotoFilename; // Menyimpan path foto ke model
        }

        $jenisCokelat->nama = $request->nama; // Memperbarui nama jenis cokelat
        $jenisCokelat->kategori = $request->kategori; // Memperbarui kategori
        $jenisCokelat->harga = $request->harga; // Memperbarui harga
        $jenisCokelat->deskripsi = $request->deskripsi; // Memperbarui deskripsi
        $jenisCokelat->jumlah_karakter = $request->jumlah_karakter; // Memperbarui jumlah karakter

        $jenisCokelat->save(); // Menyimpan perubahan ke database

        return redirect()->route('admin.jenis_cokelat')->with('success', 'Data berhasil diperbarui.'); // Mengarahkan kembali dengan pesan sukses
    }

    // Menghapus data jenis cokelat
    public function deletejenis($id){
        $cokelat = JenisCokelat::findOrFail($id); // Mencari jenis cokelat berdasarkan ID
        $cokelat->delete(); // Menghapus data dari database

        return redirect()->route('admin.jenis_cokelat')->with('success', 'Jenis Cokelat berhasil dihapus'); // Mengarahkan kembali dengan pesan sukses
    }
}
