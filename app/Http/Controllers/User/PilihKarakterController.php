<?php

namespace App\Http\Controllers\User;

use App\Models\KarakterCokelat; // Menggunakan model KarakterCokelat untuk mengakses data dari database
use App\Models\JenisCokelat; // Menggunakan model JenisCokelat untuk mengakses data dari database
use App\Models\Order; // Menggunakan model Order untuk menyimpan data pesanan
use App\Models\OrderItem; // Menggunakan model OrderItem untuk menyimpan item pesanan
use App\Models\OrderItemKarakter; // Menggunakan model OrderItemKarakter untuk menyimpan karakter item pesanan
use App\Models\Cart; 
use App\Models\CartItem;
use App\Models\CartItemKarakter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PilihKarakterController extends Controller
{
    // Metode index untuk menampilkan halaman pemilihan karakter cokelat
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

        // Ambil data jenis cokelat yang dipilih dari sesi jika ada
        $selectedJenis = session()->get('selected_jenis');
        $selectedCokelat = JenisCokelat::find($selectedJenis);
        
        // Ambil data karakter yang dipilih dari sesi jika ada
        $selectedKarakter = session()->get('selected_karakter', []);

        // Mengembalikan view dengan data karakter cokelat, kategori, jenis cokelat yang dipilih, dan karakter yang dipilih
        return view('user.pilih_karakter', compact('karakterCokelat', 'kategoris', 'kategori', 'selectedCokelat', 'selectedKarakter'));
    }

    // Metode untuk mendapatkan detail karakter cokelat berdasarkan ID
    public function getKarakterDetails($id)
    {
        // Mencari karakter cokelat berdasarkan ID
        $karakter = KarakterCokelat::find($id);

        if ($karakter) {
            // Jika karakter ditemukan, kembalikan data dalam format JSON
            return response()->json([
                'nama' => $karakter->nama,
                'foto' => $karakter->foto // Pastikan ini adalah path relatif yang benar
            ]);
        } else {
            // Jika karakter tidak ditemukan, kembalikan error 404
            return response()->json(['error' => 'Karakter tidak ditemukan'], 404);
        }
    }

    // Metode untuk menyimpan pilihan karakter cokelat yang dipilih pengguna
    public function storeSelection(Request $request)
    {
        // Mendapatkan ID karakter, jumlah, dan catatan dari request
        $karakterId = $request->input('karakter_id');
        $jumlah = $request->input('jumlah');
        $catatan = $request->input('catatan');

        // Simpan data karakter yang dipilih ke dalam sesi
        $selectedKarakter = session()->get('selected_karakter', []);
        $selectedKarakter[$karakterId] = [
            'jumlah' => (int) $jumlah,
            'catatan' => $catatan,
        ];
        session()->put('selected_karakter', $selectedKarakter);

        // Simpan log data karakter yang dipilih
        Log::info('Selected karakter data:', $selectedKarakter);

        // Kembalikan respon JSON yang menandakan penyimpanan berhasil
        return response()->json(['success' => true]);
    }

    // Metode untuk mendapatkan progres pemilihan karakter berdasarkan data di sesi
    public function getProgress()
    {
        // Ambil data karakter yang dipilih dan total karakter dari sesi
        $selectedKarakter = session()->get('selected_karakter', []);
        $totalKarakter = session()->get('total_karakter', 0);
        
        // Hitung total jumlah karakter yang dipilih
        $selectedJumlah = array_sum(array_column($selectedKarakter, 'jumlah'));

        // Hitung progres berdasarkan perbandingan jumlah karakter yang dipilih dengan total karakter yang diizinkan
        $progress = $totalKarakter > 0 ? ($selectedJumlah / $totalKarakter) * 100 : 0;

        // Kembalikan data progres dalam format JSON
        return response()->json([
            'success' => true,
            'progress' => $progress
        ]);
    }

    // Metode untuk memproses pesanan dan menyimpan data pesanan ke database
    public function processOrder()
    {
        // Ambil data pengguna yang sedang login
        $user = auth()->user();

        // Cek apakah pengguna memiliki alamat yang terdaftar
        $userAddress = $user->userAddress;
    
        // Debugging: Tampilkan data alamat
        if ($userAddress) {
            // Periksa jika alamat tidak lengkap
            if (!$userAddress->address) {
                // Redirect ke halaman profil jika alamat tidak lengkap
                return redirect()->route('user.profil', ['#alamat'])->with('message', 'Silakan lengkapi alamat Anda.');
            }
        } else {
            // Jika alamat tidak ada, redirect ke halaman profil
            return redirect()->route('user.profil', ['#alamat'])->with('message', 'Silakan lengkapi alamat Anda.');
        }

        // Ambil data dari sesi
        $selectedJenis = session()->get('selected_jenis');
        $selectedKarakter = session()->get('selected_karakter', []);

        // Simpan data pesanan ke sesi
        session()->put('order_details', [
            'selected_jenis' => $selectedJenis,
            'selected_karakter' => $selectedKarakter,
            'user_id' => auth()->id(),
        ]);

        // Simpan log data karakter yang dipilih
        Log::info('Selected karakter data during order processing:', $selectedKarakter);

        // Redirect ke halaman pemesanan
        return redirect()->route('user.pemesanan');
    }


    public function addToCart(Request $request)
    {
        // Ambil ID user yang sedang login
        $userId = auth()->id();

        // Ambil data dari sesi
        $selectedJenis = session()->get('selected_jenis');
        $selectedKarakter = session()->get('selected_karakter', []);

        // Cari atau buat keranjang baru untuk user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        // Ambil data jenis cokelat dari model JenisCokelat
        $jenisCokelat = JenisCokelat::find($selectedJenis);

        // Simpan item ke dalam keranjang
        $cartItem = $cart->items()->create([
            'jenis_cokelat_id' => $selectedJenis,
            'price' => $jenisCokelat->harga,
        ]);

        // Simpan karakter yang dipilih sebagai item keranjang
        foreach ($selectedKarakter as $karakterId => $detail) {
            $cartItem->karakterItems()->create([
                'karakter_cokelat_id' => $karakterId,
                'quantity' => $detail['jumlah'],
                'notes' => $detail['catatan'],
            ]);
        }

        // Kembalikan respon atau redirect ke halaman keranjang
        return redirect()->route('user.showCart')->with('message', 'Item ditambahkan ke keranjang.');
    }

}