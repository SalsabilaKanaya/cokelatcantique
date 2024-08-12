<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Shared\Models\JenisCokelat;
use Shared\Models\KarakterCokelat;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    public function store(Request $request)
    {
        $selectedJenis = session('selected_jenis');
        $selectedKarakter = session('selected_karakter', []);
        $orderId = $this->createOrder(); // Method untuk membuat ID pesanan baru

        foreach ($selectedKarakter as $karakterId => $detail) {
            $jenisCokelat = JenisCokelat::find($selectedJenis);

            OrderItem::create([
                'order_id' => $orderId,
                'jenis_cokelat_id' => $selectedJenis,
                'karakter_cokelat_id' => $karakterId,
                'quantity' => $detail['jumlah'],
                'notes' => $detail['catatan'],
                'price' => $jenisCokelat->harga // Atur harga sesuai kebutuhan
            ]);
        }

        // Kosongkan sesi setelah menyimpan
        session()->forget('selected_jenis');
        session()->forget('selected_karakter');
        session()->forget('total_karakter');

        return redirect()->route('pesanan_sukses'); // Redirect ke halaman sukses
    }

    private function createOrder()
    {
        // Buat entri order baru dan ambil ID-nya
        $order = DB::table('order')->insertGetId([
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $order;
    }
}
