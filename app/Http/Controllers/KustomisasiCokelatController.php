<?php

namespace App\Http\Controllers;

use Shared\Models\JenisCokelat; // Menggunakan model dari shared
use Illuminate\Http\Request;

class KustomisasiCokelatController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->input('kategori'); // Mendapatkan input kategori dari request

        if ($kategori) {
            // Jika kategori ada, filter berdasarkan kategori
            $jenisCokelat = JenisCokelat::where('kategori', $kategori)->get();
        } else {
            // Jika kategori tidak ada, ambil semua jenis cokelat
            $jenisCokelat = JenisCokelat::all();
        }

        // Mengambil semua kategori unik untuk dropdown
        $kategoris = JenisCokelat::select('kategori')->distinct()->get();

        return view('kustomisasi_cokelat', compact('jenisCokelat', 'kategoris'));
    }

}
