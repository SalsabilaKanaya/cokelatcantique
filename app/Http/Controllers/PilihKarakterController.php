<?php

namespace App\Http\Controllers;

use Shared\Models\KarakterCokelat;
use Illuminate\Http\Request;

class PilihKarakterController extends Controller
{
    public function index(Request $request) // Tambahkan parameter Request
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

        return view('pilih_karakter', compact('karakterCokelat', 'kategoris', 'kategori'));
    }

    public function getKarakterDetails($id)
    {
        // Ambil data karakter berdasarkan ID
        $karakter = KarakterCokelat::findOrFail($id);

        return response()->json($karakter);
    }
}
