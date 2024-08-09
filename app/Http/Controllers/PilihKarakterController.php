<?php

namespace App\Http\Controllers;

use Shared\Models\KarakterCokelat;
use Illuminate\Http\Request;

class PilihKarakterController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->input('kategori'); // Mendapatkan input kategori dari request

        if ($kategori) {
            // Jika kategori ada, filter berdasarkan kategori
            $karakterCokelat = KarakterCokelat::where('kategori', $kategori)->get();
        } else {
            // Jika kategori tidak ada, ambil semua karakter cokelat
            $karakterCokelat = KarakterCokelat::all();
        }

        // Mengambil semua kategori unik untuk dropdown
        $kategoris = KarakterCokelat::select('kategori')->distinct()->get();

        // Ambil data dari sesi jika ada
        $selectedCokelat = session()->get('selected_cokelat', []);
        $selectedKarakter = session()->get('selected_karakter', []);

        return view('pilih_karakter', compact('karakterCokelat', 'kategoris', 'kategori', 'selectedCokelat', 'selectedKarakter'));
    }

    public function storeSelection(Request $request)
    {
        $karakterId = $request->input('karakter_id');
        $jumlah = $request->input('jumlah');
        $catatan = $request->input('catatan');

        // Simpan data ke sesi
        $selectedKarakter = session()->get('selected_karakter', []);
        $selectedKarakter[$karakterId] = [
            'jumlah' => $jumlah,
            'catatan' => $catatan,
        ];
        session()->put('selected_karakter', $selectedKarakter);

        // Simpan jenis cokelat yang dipilih
        $selectedJenis = $request->input('jenis_cokelat_id');
        session()->put('selected_jenis', $selectedJenis);

        return redirect()->route('pilih_karakter');
    }
}
