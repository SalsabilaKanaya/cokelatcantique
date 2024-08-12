<?php

namespace App\Http\Controllers;

use Shared\Models\JenisCokelat;
use Illuminate\Http\Request;

class JenisCokelatController extends Controller
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

        return view('jenis_cokelat', compact('jenisCokelat', 'kategoris'));
    }

    public function show($id)
    {
        // Ambil jenis cokelat yang sedang ditampilkan
        $cokelat = JenisCokelat::findOrFail($id);

        // Ambil maksimal 5 jenis cokelat lain yang bukan yang sedang ditampilkan
        $jenisCokelatLainnya = JenisCokelat::where('id', '!=', $id)
                                        ->limit(5)
                                        ->get();

        // Kirim data ke view
        return view('detail_jenis_cokelat', [
            'cokelat' => $cokelat,
            'jenisCokelatLainnya' => $jenisCokelatLainnya
        ]);
    }

}
