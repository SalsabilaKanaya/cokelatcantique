<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Shared\Models\JenisCokelat;
use Shared\Models\KarakterCokelat;
use Illuminate\Http\Request;

class ProsesOrderController extends Controller
{
    public function showForm()
    {
        // Ambil data dari sesi
        $selectedJenis = session()->get('selected_jenis');
        $selectedKarakter = session()->get('selected_karakter', []);

        // Validasi jika data tidak ada di sesi
        if (!$selectedJenis) {
            return redirect()->route('kustomisasi_cokelat')->withErrors('Jenis cokelat belum dipilih');
        }

        // Mengambil detail jenis cokelat
        $jenisCokelat = JenisCokelat::find($selectedJenis);
        $karakterCokelat = KarakterCokelat::whereIn('id', array_keys($selectedKarakter))->get();

        return view('proses_pesanan', compact('jenisCokelat', 'karakterCokelat', 'selectedKarakter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'subdistrict' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|string',
            'shipping_cost' => 'required|numeric',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Ambil data dari sesi
        $selectedJenis = session()->get('selected_jenis');
        $selectedKarakter = session()->get('selected_karakter', []);

        if (!$selectedJenis) {
            return redirect()->route('kustomisasi_cokelat')->withErrors('Jenis cokelat belum dipilih');
        }

        // Simpan pesanan
        $order = Order::create([
            'user_id' => auth()->id(), // Sesuaikan dengan logika autentikasi Anda
            'status' => 'pending',
            'total_price' => $this->calculateTotalPrice($selectedJenis, $selectedKarakter) + $request->input('shipping_cost'),
            'payment_method' => $request->input('payment_method'),
            'notes' => $request->input('notes', ''),
        ]);

        foreach ($selectedKarakter as $karakterId => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'karakter_cokelat_id' => $karakterId,
                'jumlah' => $details['jumlah'],
                'catatan' => $details['catatan'],
            ]);
        }

        OrderAddress::create([
            'order_id' => $order->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'subdistrict' => $request->input('subdistrict'),
            'city' => $request->input('city'),
            'province' => $request->input('province'),
            'postal_code' => $request->input('postal_code'),
            'shipping_cost' => $request->input('shipping_cost'),
        ]);

        // Hapus data dari sesi setelah pesanan disimpan
        session()->forget(['selected_jenis', 'selected_karakter']);

        // Redirect ke halaman konfirmasi atau terima kasih
        return redirect()->route('thank_you');
    }

    private function calculateTotalPrice($jenisCokelatId, $selectedKarakter)
    {
        $jenisCokelat = JenisCokelat::find($jenisCokelatId);
        $totalPrice = $jenisCokelat->harga;

        // Misalkan setiap karakter memiliki harga tambahan
        foreach ($selectedKarakter as $karakterId => $details) {
            $karakter = KarakterCokelat::find($karakterId);
            $totalPrice += $karakter->harga * $details['jumlah'];
        }

        return $totalPrice;
    }
}
