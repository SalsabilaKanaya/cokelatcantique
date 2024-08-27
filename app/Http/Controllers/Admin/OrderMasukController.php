<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderMasukController extends Controller
{
    // Menampilkan dashboard dengan daftar order yang statusnya 'pending'
    public function dashboard()
    {
        // Mengambil semua order yang statusnya 'pending'
        $orders = Order::where('status', 'pending') // Mencari order dengan status 'pending'
                    ->with(['user', 'items.jenisCokelat']) // Memuat relasi user dan jenisCokelat terkait
                    ->get(); // Mengambil semua order yang cocok

        return view('admin.dashboard', compact('orders')); // Mengarahkan ke view dashboard dengan data orders
    }

    // Menerima order yang dipilih
    public function acceptOrder(Order $order)
    {
        $order->status = 'accepted'; // Mengubah status order menjadi 'accepted'
        $order->save(); // Menyimpan perubahan ke database

        return redirect()->route('admin.dashboard')->with('success', 'Order accepted successfully.'); // Mengarahkan kembali ke dashboard dengan pesan sukses
    }

    // Menolak order yang dipilih
    public function rejectOrder(Order $order)
    {
        $order->status = 'rejected'; // Mengubah status order menjadi 'rejected'
        $order->save(); // Menyimpan perubahan ke database

        return redirect()->route('admin.dashboard')->with('success', 'Order rejected successfully.'); // Mengarahkan kembali ke dashboard dengan pesan sukses
    }

    // Menampilkan daftar order yang sudah diterima
    public function orderList(Request $request)
    {
        // Ambil parameter sort_order dari request, default ke 'desc' (terbaru)
        $sortOrder = $request->input('sort_order', 'desc');

        // Filter order yang sudah diterima
        $orders = Order::whereIn('status', ['accepted', 'completed']) // Mencari order dengan status 'accepted'
                    ->with(['user', 'items.jenisCokelat']) // Memuat relasi user dan jenisCokelat terkait
                    ->orderBy('created_at', $sortOrder) // Urutkan berdasarkan tanggal pembuatan
                    ->get(); // Mengambil semua order yang cocok
                    
        return view('admin.order_list', compact('orders')); // Mengarahkan ke view order_list dengan data orders
    }

    // Menampilkan detail dari order yang dipilih
    public function detailOrder(Order $order)
    {
        // Ambil semua relasi yang diperlukan
        $order->load(['user', 'items.jenisCokelat', 'items.karakterItems.karakterCokelat', 'userAddress']); // Memuat relasi user, jenisCokelat, karakterCokelat, dan userAddress

        // Hitung subtotal (total semua item sebelum biaya pengiriman)
        $subtotal = $order->items->sum('price'); // Menghitung total harga dari semua item dalam order

        return view('admin.detail_order', compact('order', 'subtotal')); // Mengarahkan ke view detail_order dengan data order dan subtotal
    }

    public function markAsDone(Order $order)
    {
        $order->status = 'completed'; // Update status ke 'completed'
        $order->save();

        // Log data untuk debugging
        \Log::info('Order marked as done:', ['order' => $order]);

        return response()->json(['status' => 'success']);
    }


}
