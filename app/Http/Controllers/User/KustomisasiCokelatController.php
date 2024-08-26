<?php

namespace App\Http\Controllers\User;

use App\Models\JenisCokelat; // Menggunakan model JenisCokelat untuk mengakses data dari database
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KustomisasiCokelatController extends Controller
{
    // Metode index untuk menampilkan daftar jenis cokelat yang dapat dikustomisasi
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
        return view('user.kustomisasi_cokelat', compact('jenisCokelat', 'kategoris'));
    }

    // Metode untuk menyimpan pilihan jenis cokelat yang akan dikustomisasi
    public function storeJenisCokelatSelection(Request $request)
    {
        // Mendapatkan ID jenis cokelat dari request
        $jenisCokelatId = $request->input('jenis_cokelat_id');
        
        // Mencari jenis cokelat berdasarkan ID
        $jenisCokelat = JenisCokelat::find($jenisCokelatId);

        if ($jenisCokelat) {
            // Jika jenis cokelat ditemukan, simpan jumlah karakter yang diizinkan dalam session
            session()->put('total_karakter', $jenisCokelat->jumlah_karakter);
        }

        // Menghapus data karakter yang dipilih sebelumnya dari session
        session()->forget('selected_karakter');
        // Menyimpan ID jenis cokelat yang dipilih ke dalam session
        session()->put('selected_jenis', $jenisCokelatId);

        // Redirect ke halaman pemilihan karakter
        return redirect()->route('user.pilih_karakter');
    }
}
