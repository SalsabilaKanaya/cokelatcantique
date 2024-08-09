<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderAddress;
use Illuminate\Http\Request;

class FinalOrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'subdistrict' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|string',
            'shipping_cost' => 'required|numeric',
            'notes' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(), // Sesuaikan dengan logika autentikasi Anda
            'status' => 'pending',
            'delivery_date' => now()->addDays(3), // Atur sesuai kebutuhan
            'notes' => $data['notes'],
            'total_price' => 100000 + $data['shipping_cost'], // Simulasi total harga
            'payment_method' => $data['payment_method'],
        ]);

        OrderAddress::create([
            'order_id' => $order->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'subdistrict' => $data['subdistrict'],
            'city' => $data['city'],
            'province' => $data['province'],
            'postal_code' => $data['postal_code'],
            'shipping_cost' => $data['shipping_cost'],
        ]);

        // Redirect atau tampilkan halaman terima kasih
        return redirect()->route('thank_you'); // Ganti dengan rute halaman terima kasih
    }
}
