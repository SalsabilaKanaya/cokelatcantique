<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HistoriController extends Controller
{
    public function showHistori()
    {
        // Ambil user ID yang sedang login
        $userId = Auth::id();

        // Ambil semua order user yang statusnya 'completed' atau sesuai kebutuhan
        // Dengan memuat relasi 'items', 'jenisCokelat', 'karakterItems', dan 'karakterCokelat'
        $orders = Order::with(['items.jenisCokelat', 'items.karakterItems.karakterCokelat'])
            ->where('user_id', $userId) // Filter order berdasarkan ID user yang sedang login
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung subtotal untuk setiap order
        foreach ($orders as $order) {
            $order->subtotal = $order->items->sum('price');
        }

        // Kembalikan ke view 'user.histori' dengan data orders
        return view('user.histori', compact('orders'));
    }

    public function showDetail(Order $order)
    {
        // Load semua relasi yang dibutuhkan untuk detail order
        $order->load([
            'items.jenisCokelat', // Relasi ke jenis cokelat dari setiap item
            'items.karakterItems.karakterCokelat', // Relasi ke karakter cokelat dari setiap item karakter
            'userAddress', // Relasi ke alamat pengguna
            'user' // Relasi ke data pengguna
        ]);

        // Menghitung subtotal dari semua item dalam order
        $subtotal = $order->items->sum('price');

        // Kembalikan ke view 'user.detail_histori' dengan data order dan subtotal
        return view('user.detail_histori', compact('order', 'subtotal'));
    }
}