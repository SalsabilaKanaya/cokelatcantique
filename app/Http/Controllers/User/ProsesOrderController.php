<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use App\Models\UserAddress;
use App\Models\JenisCokelat;
use App\Models\KarakterCokelat;
use App\Services\RajaongkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

 // Tambahkan ini


class ProsesOrderController extends Controller
{
    protected $rajaongkirService;

    public function __construct(RajaongkirService $rajaongkirService)
    {
        $this->rajaongkirService = $rajaongkirService;
    }

    public function index()
    {
        $order = Order::where('user_id', auth()->id())->latest()->first();
    
        $orderItems = [];
        $shippingCost = 0;
        $subtotal = 0;
        $totalPrice = 0;
    
        // Ambil alamat pengguna dari tabel user_address
        $userAddress = UserAddress::where('user_id', auth()->id())->first();
    
        if ($order) {
            $orderItems = OrderItem::with('karakterItems.karakterCokelat')
                ->where('order_id', $order->id)
                ->get();
    
            $subtotal = $orderItems->sum('price');
        }
    
        // Hitung total harga dengan biaya pengiriman jika ada
        $totalPrice = $subtotal + $shippingCost;
    
        return view('user.pemesanan', compact('order', 'orderItems', 'userAddress', 'subtotal', 'shippingCost', 'totalPrice'));
    }    

    public function shippingfee(Request $request)
    {
        $addressID = $request->input('address_id');
        $courier = $request->input('courier');
        $token = $request->input('_token'); // Log token jika perlu

        // Log data yang diterima
        Log::info('Request data:', [
            'address_id' => $addressID,
            'courier' => $courier,
            'token' => $token
        ]);

        // Ambil alamat menggunakan model UserAddress
        $address = UserAddress::findOrFail($addressID);

        $order = Order::where('user_id', auth()->id())->latest()->first();
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        // Hitung biaya pengiriman
        $availableServices = $this->calculateShippingfee($orderItems, $address, $courier);

        // Kirim ke view dengan data alamat dan kurir
        return view('user.available_services', [
            'addressID' => $addressID,
            'courier' => $courier,
            'address' => $address,
            'services' => $availableServices // Pastikan variabel ini dikirim
        ]);
    }


    private function calculateShippingfee($orderItems, $address, $courier)
    {
        $weight = 1000; // Berat barang dalam gram
        $url = 'https://api.rajaongkir.com/starter/cost';
        $apiKey = 'f587d9fb3201bbc06ed11b0116fe4b56';
        $origin = '171';

        try {
            // Mengirim permintaan ke API RajaOngkir
            $response = Http::withHeaders([
                'key' => $apiKey, // Menggunakan API Key langsung dari variabel lokal
            ])->post($url, [
                'origin' => $origin,
                'destination' => $address->city_id,
                'weight' => $weight,
                'courier' => $courier,
            ]);
            $shippingFees = json_decode($response->getBody(), true);
        } catch (\Throwable $th) {
            // Menghentikan eksekusi dan menampilkan pesan kesalahan untuk debug
            Log::error('Error calculating shipping fee: ' . $th->getMessage());
            return [];
        }

        $availableServices = []; // Perbaiki penamaan variabel
        if (!empty($shippingFees['rajaongkir']['results'])) {
            foreach ($shippingFees['rajaongkir']['results'] as $cost){
                if (!empty($cost['costs'])) {
                    foreach ($cost['costs'] as $costDetail) {
                        $availableServices[] = [
                            'service' => $costDetail['service'],
                            'description' => $costDetail['description'],
                            'etd' => $costDetail['cost'][0]['etd'],
                            'cost' => $costDetail['cost'][0]['value'],
                            'courier' => $courier,
                            'address_id' => $address->id,
                        ];
                    }
                }
            }
        }

        Log::info('Available services:', $availableServices);
        return $availableServices;
    }

    public function choosePackage(Request $request)
    {
        $addressID = $request->input('address_id');
        $courier = $request->input('courier');
        $deliveryPackage = $request->input('delivery_package');
        $address = UserAddress::findOrFail($addressID);
        $order = Order::where('user_id', auth()->id())->latest()->first();
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        // Hitung biaya pengiriman
        $availableServices = $this->calculateShippingfee($orderItems, $address, $courier);

        $selectedPackage = null;
        if (!empty($availableServices)) {
            foreach ($availableServices as $service) {
                if ($service['service'] === $deliveryPackage) {
                    $selectedPackage = $service;
                    break; // Menghentikan loop jika paket ditemukan
                }
            }
        }
        
        if ($selectedPackage === null) {
            return response()->json([
                'shipping_fee' => 0,
                'total_price' => 0,
            ]);
        }
        
        // Hitung total harga
        $subtotal = $orderItems->sum('price');
        $shippingCost = $selectedPackage['cost'];
        $totalPrice = $subtotal + $shippingCost;

        // Simpan total harga ke dalam tabel order
        $order->courier = $courier;
        $order->delivery_package = $deliveryPackage;
        $order->shipping_cost = $shippingCost;
        $order->total_price = $totalPrice;
        $order->save();

        return response()->json([
            'shipping_fee' => number_format($shippingCost, 0, ',', '.'),
            'total_price' => number_format($totalPrice, 0, ',', '.'),
        ]);
    }

    public function store(Request $request) {
        Log::info('Store method called', [
            'request_data' => $request->all()
        ]);

        // Validasi input
        $request->validate([
            'delivery_date' => 'required|date',
            'notes' => 'nullable|string',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file
        ]);

        Log::info('Validation passed.');

        // Simpan order ke database
        $order = Order::where('user_id', auth()->id())->latest()->first();
        if (!$order) {
            Log::error('Order not found for user', ['user_id' => auth()->id()]);
            return redirect()->route('pemesanan')->with('error', 'Order tidak ditemukan.');
        }

        Log::info('Order found', ['order_id' => $order->id]);

        // Simpan catatan dan tanggal pengiriman
        $order->notes = $request->input('notes');
        $order->delivery_date = $request->input('delivery_date');

        // Jika ada bukti pembayaran, simpan file
        if ($request->hasFile('payment_proof')) {
            $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
            Log::info('Payment proof uploaded', ['file_path' => $filePath]);
            $order->payment_proof = $filePath;
        }

        $order->save();

        Log::info('Order saved successfully', ['order_id' => $order->id]);

        return response()->json(['success' => 'Order berhasil disimpan!']);
    }
    
}
