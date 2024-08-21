<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderMasukController extends Controller
{
    public function dashboard()
    {
        // Mengambil semua order yang statusnya tidak 'accepted' atau 'rejected'
        $orders = Order::where('status', 'pending') // Atau gunakan status 'pending' jika ada
                    ->with(['user', 'items.jenisCokelat'])
                    ->get();

        return view('admin.dashboard', compact('orders'));
    }


    public function acceptOrder(Order $order)
    {
        $order->status = 'accepted';
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Order accepted successfully.');
    }

    public function rejectOrder(Order $order)
    {
        $order->status = 'rejected';
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Order rejected successfully.');
    }

    public function orderList(Request $request)
    {
        // Filter order yang sudah diterima
        $orders = Order::where('status', 'accepted')
                    ->with(['user', 'items.jenisCokelat'])
                    ->get();

        return view('admin.order_list', compact('orders'));
    }

    public function detailOrder(Order $order)
    {
        // Ambil semua relasi yang diperlukan
        $order->load(['user', 'items.jenisCokelat', 'items.karakterItems.karakterCokelat', 'userAddress']);
        
        // Hitung subtotal (total semua item sebelum biaya pengiriman)
        $subtotal = $order->items->sum('price');

        // dd($order);

        return view('admin.detail_order', compact('order', 'subtotal'));
    }
}
