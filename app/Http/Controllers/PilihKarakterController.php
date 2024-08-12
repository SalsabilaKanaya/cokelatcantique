<?php

namespace App\Http\Controllers;

use Shared\Models\KarakterCokelat;
use Shared\Models\JenisCokelat;
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
        $selectedJenis = session()->get('selected_jenis');
        $selectedCokelat = JenisCokelat::find($selectedJenis);
        $selectedKarakter = session()->get('selected_karakter', []);

        return view('pilih_karakter', compact('karakterCokelat', 'kategoris', 'kategori', 'selectedCokelat', 'selectedKarakter'));
    }

    public function getKarakterDetails($id)
    {
        $karakter = KarakterCokelat::find($id);

        if ($karakter) {
            return response()->json([
                'nama' => $karakter->nama,
                'foto' => $karakter->foto // Pastikan ini adalah path relatif yang benar
            ]);
        } else {
            return response()->json(['error' => 'Karakter tidak ditemukan'], 404);
        }
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

        return response()->json(['success' => true]);
    }

    public function getProgress()
    {
        $selectedKarakter = session()->get('selected_karakter', []);
        $totalKarakter = session()->get('total_karakter', 0);
        $selectedJumlah = array_sum(array_column($selectedKarakter, 'jumlah'));

        $progress = $totalKarakter > 0 ? ($selectedJumlah / $totalKarakter) * 100 : 0;

        return response()->json([
            'success' => true,
            'progress' => $progress
        ]);
    }

}
