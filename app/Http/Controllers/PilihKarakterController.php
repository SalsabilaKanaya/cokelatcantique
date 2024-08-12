<?php

namespace App\Http\Controllers;

use Shared\Models\KarakterCokelat;
use Shared\Models\JenisCokelat;
use App\Models\Order; // Pastikan ini mengarah ke model yang benar
use App\Models\OrderItem;
use App\Models\OrderItemKarakter;
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

    // public function processOrder()
    // {
    //     $selectedJenis = session()->get('selected_jenis');
    //     $selectedKarakter = session()->get('selected_karakter', []);
    //     $orderId = Order::create(['user_id' => auth()->id()])->id; // Buat entri order baru dan ambil ID-nya

    //     if ($selectedJenis) {
    //         $jenisCokelat = JenisCokelat::find($selectedJenis);
    //         if ($jenisCokelat) {
    //             $orderItem = new OrderItem();
    //             $orderItem->order_id = $orderId;
    //             $orderItem->jenis_cokelat_id = $jenisCokelat->id;
    //             $orderItem->quantity = 1; // Default atau sesuai dengan kebutuhan
    //             $orderItem->price = $jenisCokelat->harga;
    //             $orderItem->save();
    //         }
    //     }

    //     foreach ($selectedKarakter as $karakterId => $detail) {
    //         $karakterCokelat = KarakterCokelat::find($karakterId);
    //         if ($karakterCokelat) {
    //             $orderItem = new OrderItem();
    //             $orderItem->order_id = $orderId;
    //             $orderItem->jenis_cokelat_id = $selectedJenis; // Jika setiap karakter terkait dengan jenis cokelat
    //             $orderItem->karakter_cokelat_id = $karakterCokelat->id;
    //             $orderItem->quantity = $detail['jumlah'];
    //             $orderItem->notes = $detail['catatan'];
    //             $orderItem->price = $karakterCokelat->harga; // Sesuaikan harga jika diperlukan
    //             $orderItem->save();
    //         }
    //     }

    //     // Kosongkan sesi setelah order diproses
    //     session()->forget('selected_jenis');
    //     session()->forget('selected_karakter');
    //     session()->forget('total_karakter');

    //     return redirect()->route('pemesanan'); // Arahkan ke halaman pemesanan
    // }

    public function processOrder()
    {
        $selectedJenis = session()->get('selected_jenis');
        $selectedKarakter = session()->get('selected_karakter', []);

        // Buat entri order baru
        $order = Order::create([
            'user_id' => auth()->id(),
            'delivery_date' => now()->addDays(7),
            'notes' => '',
            'total_price' => 0,
            'payment_method' => 'transfer_bca'
        ]);

        $jenisCokelat = JenisCokelat::find($selectedJenis);
        $totalPrice = 0;

        if ($jenisCokelat) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->jenis_cokelat_id = $selectedJenis;
            $orderItem->price = $jenisCokelat->harga;
            $orderItem->save();

            foreach ($selectedKarakter as $karakterId => $detail) {
                $karakterItem = new OrderItemKarakter();
                $karakterItem->order_item_id = $orderItem->id;
                $karakterItem->karakter_cokelat_id = $karakterId;
                $karakterItem->quantity = $detail['jumlah'];
                $karakterItem->notes = $detail['catatan'];
                $karakterItem->save();
            }

            $totalPrice += $orderItem->price;
        }

        // Update total harga di Order
        $order->total_price = $totalPrice;
        $order->save();

        // Kosongkan sesi setelah pemesanan diproses
        session()->forget('selected_jenis');
        session()->forget('selected_karakter');
        session()->forget('total_karakter');

        return redirect()->route('pemesanan');
    }

}
