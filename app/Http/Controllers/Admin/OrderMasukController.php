<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class OrderMasukController extends Controller
{
    // Menampilkan dashboard dengan daftar order yang statusnya 'pending'
    public function dashboard()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Jumlah orderan yang masuk pada bulan ini
        $totalSales = Order::whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->count();

        // Jumlah orderan yang masuk pada bulan sebelumnya
        $previousMonth = Carbon::now()->subMonth()->month;
        $previousYear = Carbon::now()->subMonth()->year;
        $previousMonthSales = Order::whereMonth('created_at', $previousMonth)
                                    ->whereYear('created_at', $previousYear)
                                    ->count();

        // Menghitung persentase peningkatan order
        if ($previousMonthSales > 0) {
            $increasePercentage = (($totalSales - $previousMonthSales) / $previousMonthSales) * 100;
        } else {
            $increasePercentage = $totalSales > 0 ? 100 : 0; // Jika bulan sebelumnya tidak ada order, anggap peningkatan 100% jika ada order bulan ini
        }

        // Jumlah pendapatan per bulan
        $totalRevenue = Order::whereIn('status', ['accepted', 'completed'])
                            ->whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                            ->sum('total_price');

        // Jumlah pendapatan bulan sebelumnya
        $previousMonthRevenue = Order::whereIn('status', ['accepted', 'completed'])
                                    ->whereMonth('created_at', $previousMonth)
                                    ->whereYear('created_at', $previousYear)
                                    ->sum('total_price');

        // Menghitung persentase peningkatan pendapatan
        if ($previousMonthRevenue > 0) {
            $revenueIncreasePercentage = (($totalRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100;
        } else {
            $revenueIncreasePercentage = $totalRevenue > 0 ? 100 : 0; // Jika bulan sebelumnya tidak ada pendapatan, anggap peningkatan 100% jika ada pendapatan bulan ini
        }

        // Mengambil semua order yang statusnya 'pending'
        $orders = Order::where('status', 'pending') // Mencari order dengan status 'pending'
                    ->with(['user', 'items.jenisCokelat']) // Memuat relasi user dan jenisCokelat terkait
                    ->orderBy('created_at', 'desc')
                    ->paginate(6); // Mengambil semua order yang cocok

        return view('admin.dashboard', compact('orders', 'totalSales', 'totalRevenue', 'increasePercentage', 'revenueIncreasePercentage')); // Mengarahkan ke view dashboard dengan data orders
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
        $activeTab = $request->input('active_tab', 'proses');

        // Filter order yang sudah diterima
        $ordersAccepted = Order::where('status', 'accepted') // Mencari order dengan status 'accepted'
                    ->with(['user', 'items.jenisCokelat']) // Memuat relasi user dan jenisCokelat terkait
                    ->orderBy('created_at', $sortOrder) // Urutkan berdasarkan tanggal pembuatan
                    ->paginate(5); // Mengambil semua order yang cocok dengan pagination

        $ordersCompleted = Order::where('status', 'completed') // Mencari order dengan status 'completed'
                    ->with(['user', 'items.jenisCokelat']) // Memuat relasi user dan jenisCokelat terkait
                    ->orderBy('created_at', $sortOrder) // Urutkan berdasarkan tanggal pembuatan
                    ->paginate(5); // Mengambil semua order yang cocok dengan pagination
                    
        return view('admin.order_list', compact('ordersAccepted', 'ordersCompleted', 'activeTab')); // Mengarahkan ke view order_list dengan data orders
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