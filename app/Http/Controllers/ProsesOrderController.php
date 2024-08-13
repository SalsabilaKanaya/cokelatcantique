<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Shared\Models\JenisCokelat;
use Shared\Models\KarakterCokelat;
use App\Services\RajaongkirService;
use Illuminate\Http\Request;

class ProsesOrderController extends Controller
{
    protected $rajaongkirService;

    public function __construct(RajaongkirService $rajaongkirService)
    {
        $this->rajaongkirService = $rajaongkirService;
    }

    public function index()
    {
        // Ambil order terbaru untuk pengguna yang sedang login
        $order = Order::where('user_id', auth()->id())->latest()->first();

        $orderItems = [];
        $shippingCost = 0;
        
        if ($order) {
            // Ambil semua order items terkait dengan order ini
            $orderItems = OrderItem::with('karakterItems.karakterCokelat')
                ->where('order_id', $order->id)
                ->get();

            // Hitung ongkos kirim jika orderAddress ada
            $orderAddress = $order->orderAddress;
            if ($orderAddress) {
                $provinceId = $this->getProvinceIdByName($orderAddress->province);
                $cityId = $this->getCityIdByName($orderAddress->city);
                $weight = 1000; // Sesuaikan dengan berat produk yang dibeli
                $courier = 'jne'; // Sesuaikan dengan kurir yang dipilih

                $shippingCostResponse = $this->rajaongkirService->getShippingCost(171, $cityId, $weight, $courier); // 501 adalah ID origin, sesuaikan dengan ID asal

                $shippingCost = $shippingCostResponse['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
            }
        }

        return view('pemesanan', compact('order', 'orderItems', 'shippingCost'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'note' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'delivery_date' => 'required|date',
            'address' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        // Ambil order terbaru untuk pengguna yang sedang login
        $order = Order::where('user_id', auth()->id())->latest()->first();

        // Update catatan di tabel order
        if ($order) {
            $order->notes = $request->input('note');
            $order->save();

            // Hitung ongkos kirim
            $provinceId = $this->getProvinceIdByName($request->input('province'));
            $cityId = $this->getCityIdByName($request->input('city'));
            $weight = 1000; // Sesuaikan dengan berat produk yang dibeli
            $courier = 'jne'; // Sesuaikan dengan kurir yang dipilih

            $shippingCostResponse = $this->rajaongkirService->getShippingCost(171, $cityId, $weight, $courier); // 501 adalah ID origin, sesuaikan dengan ID asal
            $shippingCost = $shippingCostResponse['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

            // Simpan data alamat di tabel order_address
            $orderAddress = $order->orderAddress;
            if (!$orderAddress) {
                $orderAddress = new OrderAddress();
            }
            $orderAddress->order_id = $order->id;
            $orderAddress->name = $request->input('name');
            $orderAddress->email = $request->input('email');
            $orderAddress->phone_number = $request->input('phone_number');
            $orderAddress->delivery_date = $request->input('delivery_date');
            $orderAddress->address = $request->input('address');
            $orderAddress->subdistrict = $request->input('subdistrict');
            $orderAddress->city = $request->input('city');
            $orderAddress->province = $request->input('province');
            $orderAddress->postal_code = $request->input('postal_code');
            $orderAddress->save();

            // Kirimkan response sebagai JSON
            return response()->json([
                'success' => true,
                'shippingCost' => $shippingCost,
                // 'totalPrice' => $totalPrice, // Jika perlu
            ]);
        }

        return response()->json(['success' => false]);
    }

    // ProsesOrderController.php

    public function calculateShippingCost(Request $request)
    {
        // Ambil data dari request
        $province = $request->input('province');
        $city = $request->input('city');
        $weight = $request->input('weight'); // Asumsikan berat diambil dari request

        // Validasi input
        if (!$province || !$city || !$weight) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        // Contoh API URL (ubah dengan URL sebenarnya)
        $apiUrl = "https://api.rajaongkir.com/starter/cost";
        
        // Ganti dengan data API Anda
        $apiKey = 'f587d9fb3201bbc06ed11b0116fe4b56';

        // Inisialisasi cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'origin' => 'YOUR_ORIGIN_ID', // ID asal
            'destination' => $city,
            'weight' => $weight,
            'courier' => 'jne' // Contoh kurir, ganti sesuai kebutuhan
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'key: ' . $apiKey
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        // Cek jika cURL gagal
        if ($response === false) {
            return response()->json(['error' => 'Failed to fetch shipping cost'], 500);
        }

        $responseArray = json_decode($response, true);

        // Cek jika json_decode gagal
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON response from API'], 500);
        }

        // Pastikan 'results' ada dalam respons
        if (isset($responseArray['rajaongkir']['results'])) {
            $shippingCost = $responseArray['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value']; // Ubah sesuai struktur JSON yang diterima
            return response()->json(['shippingCost' => $shippingCost]);
        } else {
            return response()->json(['error' => 'Shipping cost data not found'], 404);
        }
    }

    

    protected function getProvinceIdByName($provinceName)
    {
        $provinces = $this->rajaongkirService->getProvinces();
        foreach ($provinces['rajaongkir']['results'] as $province) {
            if (strtolower($province['province']) === strtolower($provinceName)) {
                return $province['province_id'];
            }
        }
        return null;
    }

    protected function getCityIdByName($cityName)
    {
        $provinceId = $this->getProvinceIdByName(request()->input('province'));
        if ($provinceId) {
            $cities = $this->rajaongkirService->getCities($provinceId);
            foreach ($cities['rajaongkir']['results'] as $city) {
                if (strtolower($city['city_name']) === strtolower($cityName)) {
                    return $city['city_id'];
                }
            }
        }
        return null;
    }
}
