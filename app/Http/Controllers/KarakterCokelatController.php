<?php

namespace App\Http\Controllers;

use Shared\Models\KarakterCokelat; // Menggunakan model dari shared
use Illuminate\Http\Request;

class KarakterCokelatController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->input('kategori'); // Mendapatkan input kategori dari request

        if ($kategori) {
            // Jika kategori ada, filter berdasarkan kategori
            $karakterCokelat = KarakterCokelat::where('kategori', $kategori)->get();
        } else {
            // Jika kategori tidak ada, ambil semua karakter cokelat
            $karakterCokelat =  KarakterCokelat::all();
        }

        // Mengambil semua kategori unik untuk dropdown
        $kategoris = KarakterCokelat::select('kategori')->distinct()->get();

        return view('karakter_cokelat', compact('karakterCokelat', 'kategoris'));
    }

}
