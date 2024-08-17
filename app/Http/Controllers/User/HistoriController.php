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
        $orders = Order::with(['items.jenisCokelat', 'items.karakterItems.karakterCokelat'])
            ->where('user_id', $userId)
            ->get();

        // Kembalikan ke view dengan data orders
        return view('user.histori', compact('orders'));
    }

    public function showDetail(Order $order)
    {
        // Load semua relasi yang dibutuhkan
        $order->load([
            'items.jenisCokelat',
            'items.karakterItems.karakterCokelat',
            'userAddress',
            'user'
        ]);

        // Menghitung subtotal
        $subtotal = $order->items->sum('price');

        return view('user.detail_histori', compact('order', 'subtotal'));
    }

}
