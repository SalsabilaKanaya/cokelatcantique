<?php

namespace App\Http\Controllers\User;

use App\Models\KarakterCokelat; // Menggunakan model KarakterCokelat untuk mengakses data dari database
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KarakterCokelatController extends Controller
{
    // Metode index untuk menampilkan daftar karakter cokelat berdasarkan kategori (jika ada)
    public function index(Request $request)
    {
        // Mendapatkan input kategori dari request
        $kategori = $request->input('kategori');

        if ($kategori) {
            // Jika kategori ada, ambil data karakter cokelat yang sesuai dengan kategori tersebut
            $karakterCokelat = KarakterCokelat::where('kategori', $kategori)->get();
        } else {
            // Jika kategori tidak ada, ambil semua karakter cokelat
            $karakterCokelat = KarakterCokelat::all();
        }

        // Mengambil semua kategori unik dari database untuk dropdown filter kategori di frontend
        $kategoris = KarakterCokelat::select('kategori')->distinct()->get();

        // Mengembalikan view dengan data karakter cokelat dan kategori untuk ditampilkan
        return view('user.Karakter_cokelat', compact('karakterCokelat', 'kategoris'));
    }

    // Metode show untuk menampilkan detail dari karakter cokelat tertentu
    public function show($id)
    {
        // Mencari karakter cokelat berdasarkan ID, jika tidak ditemukan akan menghasilkan 404
        $cokelat = KarakterCokelat::findOrFail($id);

        // Mengambil maksimal 5 karakter cokelat lain yang berbeda dari cokelat yang sedang ditampilkan
        $karakterCokelatLainnya = KarakterCokelat::where('id', '!=', $id)
                                        ->limit(5)
                                        ->get();

        // Mengembalikan view dengan data cokelat yang dipilih dan karakter cokelat lain untuk ditampilkan
        return view('user.detail_karakter_cokelat', [
            'cokelat' => $cokelat,
            'karakterCokelatLainnya' => $karakterCokelatLainnya
        ]);
    }

}

