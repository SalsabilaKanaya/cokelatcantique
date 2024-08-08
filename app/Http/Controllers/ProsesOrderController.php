<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Illuminate\Http\Request;

class ProsesPesananController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_cokelat_id' => 'required|exists:jenis_cokelat,id',
            'karakter' => 'array',
            'karakter.*.quantity' => 'integer|min:0',
            'karakter.*.notes' => 'nullable|string',
        ]);

        // Simulasi proses pemesanan
        $order = Order::create([
            'user_id' => auth()->id(), // Sesuaikan dengan logika autentikasi Anda
            'status' => 'pending',
            'delivery_date' => now()->addDays(3), // Atur sesuai kebutuhan
            'notes' => 'Catatan tambahan',
            'total_price' => 100000, // Simulasi total harga
            'payment_method' => 'transfer', // Sesuaikan dengan metode pembayaran
        ]);

        foreach ($data['karakter'] as $karakterId => $attributes) {
            if ($attributes['quantity'] > 0) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'chocolate_type_id' => $data['jenis_cokelat_id'],
                    'chocolate_character_id' => $karakterId,
                    'quantity' => $attributes['quantity'],
                    'notes' => $attributes['notes'],
                    'price' => 50000, // Simulasi harga per item
                ]);
            }
        }

        // Redirect ke halaman pemesanan
        return redirect()->route('halaman_pemesanan'); // Ganti dengan rute halaman pemesanan
    }
}
