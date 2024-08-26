<?php

namespace App\Http\Controllers\User;

use App\Models\JenisCokelat; // Menggunakan model JenisCokelat untuk mengakses data dari database
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JenisCokelatController extends Controller
{
    // Metode index untuk menampilkan daftar jenis cokelat berdasarkan kategori (jika ada)
    public function index(Request $request)
    {
        // Mendapatkan input kategori dari request
        $kategori = $request->input('kategori');

        if ($kategori) {
            // Jika kategori ada, ambil data jenis cokelat yang sesuai dengan kategori tersebut
            $jenisCokelat = JenisCokelat::where('kategori', $kategori)->get();
        } else {
            // Jika kategori tidak ada, ambil semua jenis cokelat
            $jenisCokelat = JenisCokelat::all();
        }

        // Mengambil semua kategori unik dari database untuk dropdown filter kategori di frontend
        $kategoris = JenisCokelat::select('kategori')->distinct()->get();

        // Mengembalikan view dengan data jenis cokelat dan kategori untuk ditampilkan
        return view('user.jenis_cokelat', compact('jenisCokelat', 'kategoris'));
    }

    // Metode show untuk menampilkan detail dari jenis cokelat tertentu
    public function show($id)
    {
        // Mencari jenis cokelat berdasarkan ID, jika tidak ditemukan akan menghasilkan 404
        $cokelat = JenisCokelat::findOrFail($id);

        // Mengambil maksimal 5 jenis cokelat lain yang berbeda dari cokelat yang sedang ditampilkan
        $jenisCokelatLainnya = JenisCokelat::where('id', '!=', $id)
                                        ->limit(5)
                                        ->get();

        // Mengembalikan view dengan data cokelat yang dipilih dan cokelat lain untuk ditampilkan
        return view('user.detail_jenis_cokelat', [
            'cokelat' => $cokelat,
            'jenisCokelatLainnya' => $jenisCokelatLainnya
        ]);
    }

}
