<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use App\Models\UserAddress;
use Shared\Models\JenisCokelat;
use Shared\Models\KarakterCokelat;
use App\Services\RajaongkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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

        // Ambil alamat pengguna dari tabel user_address
        $userAddress = UserAddress::where('user_id', auth()->id())->first();

        if ($order) {
            $orderItems = OrderItem::with('karakterItems.karakterCokelat')
                ->where('order_id', $order->id)
                ->get();
        }

        return view('pemesanan', compact('order', 'orderItems', 'userAddress'));
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
        return view('available_services', [
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


    public function store(Request $request)
    {
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

        $order = Order::where('user_id', auth()->id())->latest()->first();

        if ($order) {
            $order->notes = $request->input('note');
            $order->save();

            $provinceId = $this->getProvinceIdByName($request->input('province'));
            $cityId = $this->getCityIdByName($request->input('city'));
            $weight = 1000;
            $courier = 'jne';

            $shippingCostResponse = $this->rajaongkirService->getShippingCost(171, $cityId, $weight, $courier);
            $shippingCost = $shippingCostResponse['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

            $orderAddress = $order->orderAddress ?: new OrderAddress();
            $orderAddress->fill([
                'order_id' => $order->id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'delivery_date' => $request->input('delivery_date'),
                'address' => $request->input('address'),
                'subdistrict' => $request->input('subdistrict'),
                'city' => $request->input('city'),
                'province' => $request->input('province'),
                'postal_code' => $request->input('postal_code'),
            ])->save();

            return response()->json([
                'success' => true,
                'shippingCost' => $shippingCost,
            ]);
        }

        return response()->json(['success' => false]);
    }

    protected function getCityIdByName($cityName)
    {
        // Mendapatkan ID provinsi dari nama provinsi yang dikirimkan
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
}
