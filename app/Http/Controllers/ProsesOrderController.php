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
        $order = Order::where('user_id', auth()->id())->latest()->first();

        $orderItems = [];
        $shippingCost = 0;

        if ($order) {
            $orderItems = OrderItem::with('karakterItems.karakterCokelat')
                ->where('order_id', $order->id)
                ->get();

            $orderAddress = $order->orderAddress;
            if ($orderAddress) {
                $provinceId = $this->getProvinceIdByName($orderAddress->province);
                $cityId = $this->getCityIdByName($orderAddress->city);
                $weight = 1000; // Sesuaikan dengan berat produk
                $courier = 'jne'; // Sesuaikan dengan kurir yang dipilih

                $shippingCostResponse = $this->rajaongkirService->getShippingCost(171, $cityId, $weight, $courier);

                $shippingCost = $shippingCostResponse['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
            }
        }

        return view('pemesanan', compact('order', 'orderItems', 'shippingCost'));
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

    public function calculateShippingCost(Request $request)
{
    $request->validate([
        'province' => 'required|string',
        'city' => 'required|string',
        'courier' => 'required|string'
    ]);

    $cityId = $this->getCityIdByName($request->input('city'));

    if (!$cityId) {
        return response()->json(['error' => 'Kota tidak ditemukan'], 404);
    }

    $origin = 171; // ID kota asal yang telah ditentukan
    $weight = 1000; // Berat barang dalam gram
    $courier = $request->input('courier');

    $shippingCostResponse = $this->rajaongkirService->getShippingCost($origin, $cityId, $weight, $courier);

    // Tambahkan log untuk memeriksa respons
    \Log::info('Shipping cost response: ', ['response' => $shippingCostResponse]);

    if (isset($shippingCostResponse['rajaongkir']['results'][0]['costs'][0]['cost'][0])) {
        $costs = $shippingCostResponse['rajaongkir']['results'][0]['costs'];
        return response()->json($costs);
    } else {
        return response()->json(['error' => 'Data tidak tersedia atau format tidak sesuai'], 500);
    }
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
