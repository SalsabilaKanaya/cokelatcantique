<?php

namespace App\Http\Controllers;

use Shared\Models\KarakterCokelat;
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
            // Jika kategori tidak ada, ambil semua Karakter cokelat
            $karakterCokelat = KarakterCokelat::all();
        }

        // Mengambil semua kategori unik untuk dropdown
        $kategoris = KarakterCokelat::select('kategori')->distinct()->get();

        return view('Karakter_cokelat', compact('karakterCokelat', 'kategoris'));
    }

    public function show($id)
    {
        // Ambil Karakter cokelat yang sedang ditampilkan
        $cokelat = KarakterCokelat::findOrFail($id);

        // Ambil maksimal 5 Karakter cokelat lain yang bukan yang sedang ditampilkan
        $karakterCokelatLainnya = KarakterCokelat::where('id', '!=', $id)
                                        ->limit(5)
                                        ->get();

        // Kirim data ke view
        return view('detail_karakter_cokelat', [
            'cokelat' => $cokelat,
            'karakterCokelatLainnya' => $karakterCokelatLainnya
        ]);
    }

}
