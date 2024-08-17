<?php

namespace App\Http\Controllers\User;

use App\Models\JenisCokelat; // Menggunakan model dari shared
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        return view('user.kustomisasi_cokelat', compact('jenisCokelat', 'kategoris'));
    }

    public function storeJenisCokelatSelection(Request $request)
    {
        $jenisCokelatId = $request->input('jenis_cokelat_id');
        $jenisCokelat = JenisCokelat::find($jenisCokelatId);

        if ($jenisCokelat) {
            session()->put('total_karakter', $jenisCokelat->jumlah_karakter);
        }

        session()->forget('selected_karakter');
        session()->put('selected_jenis', $jenisCokelatId);

        return redirect()->route('pilih_karakter');
    }
}