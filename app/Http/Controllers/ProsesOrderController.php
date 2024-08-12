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

    public function calculateShippingCost(Request $request)
    {
        // Validasi input
        $request->validate([
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        $city = $request->input('city');
        $province = $request->input('province');

        // Ambil ID province dan city
        $provinceId = $this->getProvinceIdByName($province);
        $cityId = $this->getCityIdByName($city);
        $weight = 1000; // Sesuaikan dengan berat produk yang dibeli
        $courier = 'jne'; // Sesuaikan dengan kurir yang dipilih

        $shippingCostResponse = $this->rajaongkirService->getShippingCost(171, $cityId, $weight, $courier); // 171 adalah ID origin, sesuaikan dengan ID asal

        $shippingCost = $shippingCostResponse['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

        return response()->json([
            'success' => true,
            'shippingCost' => $shippingCost,
        ]);
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


    // public function showForm()
    // {
    //     // Ambil data dari sesi
    //     $selectedJenis = session()->get('selected_jenis');
    //     $selectedKarakter = session()->get('selected_karakter', []);

    //     // Validasi jika data tidak ada di sesi
    //     if (!$selectedJenis) {
    //         return redirect()->route('kustomisasi_cokelat')->withErrors('Jenis cokelat belum dipilih');
    //     }

    //     // Mengambil detail jenis cokelat
    //     $jenisCokelat = JenisCokelat::find($selectedJenis);
    //     $karakterCokelat = KarakterCokelat::whereIn('id', array_keys($selectedKarakter))->get();

    //     return view('proses_pesanan', compact('jenisCokelat', 'karakterCokelat', 'selectedKarakter'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email',
    //         'phone_number' => 'required|string',
    //         'address' => 'required|string',
    //         'subdistrict' => 'required|string',
    //         'city' => 'required|string',
    //         'province' => 'required|string',
    //         'postal_code' => 'required|string',
    //         'shipping_cost' => 'required|numeric',
    //         'payment_method' => 'required|string',
    //         'notes' => 'nullable|string',
    //     ]);

    //     // Ambil data dari sesi
    //     $selectedJenis = session()->get('selected_jenis');
    //     $selectedKarakter = session()->get('selected_karakter', []);

    //     if (!$selectedJenis) {
    //         return redirect()->route('kustomisasi_cokelat')->withErrors('Jenis cokelat belum dipilih');
    //     }

    //     // Simpan pesanan
    //     $order = Order::create([
    //         'user_id' => auth()->id(), // Sesuaikan dengan logika autentikasi Anda
    //         'status' => 'pending',
    //         'total_price' => $this->calculateTotalPrice($selectedJenis, $selectedKarakter) + $request->input('shipping_cost'),
    //         'payment_method' => $request->input('payment_method'),
    //         'notes' => $request->input('notes', ''),
    //     ]);

    //     foreach ($selectedKarakter as $karakterId => $details) {
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'karakter_cokelat_id' => $karakterId,
    //             'jumlah' => $details['jumlah'],
    //             'catatan' => $details['catatan'],
    //         ]);
    //     }

    //     OrderAddress::create([
    //         'order_id' => $order->id,
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'phone_number' => $request->input('phone_number'),
    //         'address' => $request->input('address'),
    //         'subdistrict' => $request->input('subdistrict'),
    //         'city' => $request->input('city'),
    //         'province' => $request->input('province'),
    //         'postal_code' => $request->input('postal_code'),
    //         'shipping_cost' => $request->input('shipping_cost'),
    //     ]);

    //     // Hapus data dari sesi setelah pesanan disimpan
    //     session()->forget(['selected_jenis', 'selected_karakter']);

    //     // Redirect ke halaman konfirmasi atau terima kasih
    //     return redirect()->route('thank_you');
    // }

    // private function calculateTotalPrice($jenisCokelatId, $selectedKarakter)
    // {
    //     $jenisCokelat = JenisCokelat::find($jenisCokelatId);
    //     $totalPrice = $jenisCokelat->harga;

    //     // Misalkan setiap karakter memiliki harga tambahan
    //     foreach ($selectedKarakter as $karakterId => $details) {
    //         $karakter = KarakterCokelat::find($karakterId);
    //         $totalPrice += $karakter->harga * $details['jumlah'];
    //     }

    //     return $totalPrice;
    // }
}
