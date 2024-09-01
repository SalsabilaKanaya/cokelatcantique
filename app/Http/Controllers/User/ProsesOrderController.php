<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemKarakter;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemKarakter;
use App\Models\OrderAddress;
use App\Models\UserAddress;
use App\Models\JenisCokelat;
use App\Models\KarakterCokelat;
use App\Services\RajaongkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Events\NavbarClicked;

class ProsesOrderController extends Controller
{
    // Menginisialisasi RajaongkirService yang digunakan untuk menghitung biaya pengiriman
    protected $rajaongkirService;

    public function __construct(RajaongkirService $rajaongkirService)
    {
        $this->rajaongkirService = $rajaongkirService;
    }

    // Menampilkan halaman pemesanan dengan detail pesanan terbaru dari pengguna
    public function index(Request $request)
    {
        // if ($request->query('navbar_click')) {
        //     event(new NavbarClicked());
        // }

        \Log::info('Pemesanan page accessed');
        \Log::info('Session data on pemesanan page:', session()->all());
        // Ambil data dari sesi
        $selectedItems = session()->get('selected_items', []);
        $orderDetails = session()->get('order_details', []);

        \Log::info('Selected items from session:', $selectedItems);
        \Log::info('Order details from session:', $orderDetails);

        $jenisCokelat = [];
        $karakterCokelat = [];
        $selectedKarakter = [];
        $subtotal = 0;

        if (!empty($selectedItems)) {
            // Case 1: Data berasal dari keranjang
            foreach ($selectedItems as $item) {
                $jenis = JenisCokelat::find($item['jenis_cokelat_id']);
                if ($jenis) {
                    $jenisCokelat[] = $jenis;
                    $subtotal += $jenis->harga;
                }

                if (isset($item['karakter_items'])) {
                    foreach ($item['karakter_items'] as $karakterItem) {
                        $selectedKarakter[$item['jenis_cokelat_id']][] = [
                            'nama' => KarakterCokelat::find($karakterItem['karakter_cokelat_id'])->nama,
                            'notes' => $karakterItem['notes'] ?? '',
                        ];
                    }
                }
            }
        } elseif (!empty($orderDetails)) {
            // Case 2: Data berasal dari sesi pemesanan langsung
            $selectedJenis = $orderDetails['selected_jenis'];
            $selectedKarakter = $orderDetails['selected_karakter'];

            $jenis = JenisCokelat::find($selectedJenis);
            if ($jenis) {
                $jenisCokelat[] = $jenis;
                $subtotal += $jenis->harga;
            }

            foreach ($selectedKarakter as $karakterId => $karakterDetail) {
                $karakter = KarakterCokelat::find($karakterId);
                if ($karakter) {
                    $karakterCokelat[] = $karakter;
                    $selectedKarakter[$selectedJenis][] = [
                        'nama' => $karakter->nama,
                        'notes' => $karakterDetail['catatan'] ?? '',
                    ];
                }
            }
        } else {
            // return redirect()->route('user.showCart')->with('error', 'Tidak ada item yang dipilih.');
        }

        // Ambil alamat pengguna dari tabel user_address
        $userAddress = UserAddress::where('user_id', auth()->id())->first();

        // Inisialisasi biaya pengiriman
        $shippingCost = 0; // Misalnya, $shippingCost dihitung berdasarkan logika yang ada atau API eksternal

        // Hitung total harga
        $totalPrice = $subtotal + $shippingCost;

        // Kirim data ke view
        return view('user.pemesanan', compact('jenisCokelat', 'karakterCokelat', 'selectedKarakter', 'userAddress', 'subtotal', 'shippingCost', 'totalPrice'));
    }

    // Menghitung biaya pengiriman berdasarkan alamat dan kurir yang dipilih
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

        // Ambil data pesanan dari sesi
        $selectedItems = session()->get('selected_items', []);
        $orderDetails = session()->get('order_details', []);

        // Tambahkan pengecekan apakah selectedItems atau orderDetails ditemukan
        if (empty($selectedItems) && empty($orderDetails)) {
            Log::error('No selected items or order details found in session for user', ['user_id' => auth()->id()]);
            return response()->json(['error' => 'No selected items or order details found. Please add items to your cart first.'], 404);
        }

        // Buat array orderItems dari selectedItems atau orderDetails
        $orderItems = collect();

        if (!empty($selectedItems)) {
            // Case 1: Data berasal dari keranjang
            $orderItems = collect($selectedItems)->map(function ($item) {
                return (object) [
                    'id' => $item['id'],
                    'cart_id' => $item['cart_id'],
                    'jenis_cokelat_id' => $item['jenis_cokelat_id'],
                    'price' => $item['price'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at'],
                    'karakter_items' => collect($item['karakter_items'])->map(function ($karakterItem) {
                        return (object) [
                            'karakter_cokelat_id' => $karakterItem['karakter_cokelat_id'],
                            'quantity' => $karakterItem['quantity'],
                            'notes' => $karakterItem['notes'],
                        ];
                    }),
                ];
            });
        } elseif (!empty($orderDetails)) {
            // Case 2: Data berasal dari sesi pemesanan langsung
            $selectedJenis = $orderDetails['selected_jenis'];
            $selectedKarakter = $orderDetails['selected_karakter'];

            $orderItems->push((object) [
                'jenis_cokelat_id' => $selectedJenis,
                'karakter_items' => collect($selectedKarakter)->map(function ($karakterDetail, $karakterId) {
                    return (object) [
                        'karakter_cokelat_id' => $karakterId,
                        'quantity' => $karakterDetail['jumlah'] ?? 1,
                        'notes' => $karakterDetail['catatan'] ?? '',
                    ];
                }),
            ]);
        }
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

    // Menghitung biaya pengiriman menggunakan API RajaOngkir
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

    // Memilih paket pengiriman dan menyimpan informasi biaya pengiriman
    public function choosePackage(Request $request)
    {
        $addressID = $request->input('address_id');
        $courier = $request->input('courier');
        $deliveryPackage = $request->input('delivery_package');
        $address = UserAddress::findOrFail($addressID);

        // Ambil data pesanan dari sesi
        $selectedItems = session()->get('selected_items', []);
        $orderDetails = session()->get('order_details', []);

        // Tambahkan pengecekan apakah selectedItems atau orderDetails ditemukan
        if (empty($selectedItems) && empty($orderDetails)) {
            Log::error('No selected items or order details found in session for user', ['user_id' => auth()->id()]);
            return response()->json(['error' => 'No selected items or order details found. Please add items to your cart first.'], 404);
        }

        // Buat array orderItems dari selectedItems atau orderDetails
        $orderItems = collect();

        if (!empty($selectedItems)) {
            // Case 1: Data berasal dari keranjang
            $orderItems = collect($selectedItems)->map(function ($item) {
                return (object) [
                    'id' => $item['id'],
                    'cart_id' => $item['cart_id'],
                    'jenis_cokelat_id' => $item['jenis_cokelat_id'],
                    'price' => $item['price'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at'],
                    'karakter_items' => collect($item['karakter_items'])->map(function ($karakterItem) {
                        return (object) [
                            'karakter_cokelat_id' => $karakterItem['karakter_cokelat_id'],
                            'quantity' => $karakterItem['quantity'],
                            'notes' => $karakterItem['notes'],
                        ];
                    }),
                ];
            });
        } elseif (!empty($orderDetails)) {
            // Case 2: Data berasal dari sesi pemesanan langsung
            $selectedJenis = $orderDetails['selected_jenis'];
            $selectedKarakter = $orderDetails['selected_karakter'];

            $orderItems->push((object) [
                'jenis_cokelat_id' => $selectedJenis,
                'karakter_items' => collect($selectedKarakter)->map(function ($karakterDetail, $karakterId) {
                    return (object) [
                        'karakter_cokelat_id' => $karakterId,
                        'quantity' => $karakterDetail['jumlah'] ?? 1,
                        'notes' => $karakterDetail['catatan'] ?? '',
                    ];
                }),
            ]);
        }
        
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

        // // Ambil data dari sesi
        // $selectedJenis = session()->get('order_details.selected_jenis');

        // // Ambil data jenis cokelat dari database berdasarkan ID yang disimpan di sesi
        // $jenisCokelat = JenisCokelat::find($selectedJenis);

        $subtotal = 0;

        if (!empty($selectedItems)) {
            // Case 1: Data berasal dari keranjang
            foreach ($selectedItems as $item) {
                $jenis = JenisCokelat::find($item['jenis_cokelat_id']);
                if ($jenis) {
                    $subtotal += $jenis->harga;
                } else {
                    Log::error('JenisCokelat tidak ditemukan', ['jenis_cokelat_id' => $item['jenis_cokelat_id']]);
                    return response()->json([
                        'shipping_fee' => 0,
                        'total_price' => 0,
                    ]);
                }
            }
        } elseif (!empty($orderDetails)) {
            // Case 2: Data berasal dari sesi pemesanan langsung
            $selectedJenis = $orderDetails['selected_jenis'];
            $jenisCokelat = JenisCokelat::find($selectedJenis);
            if ($jenisCokelat) {
                $subtotal = $jenisCokelat->harga;
            } else {
                Log::error('JenisCokelat tidak ditemukan', ['selected_jenis' => $selectedJenis]);
                return response()->json([
                    'shipping_fee' => 0,
                    'total_price' => 0,
                ]);
            }
        } else {
            return response()->json([
                'shipping_fee' => 0,
                'total_price' => 0,
            ]);
        }


        // Hitung total harga
        $shippingCost = $selectedPackage['cost'];
        $totalPrice = $subtotal + $shippingCost;

        // Simpan informasi ke dalam sesi dengan nama yang berbeda
        session()->put('shipping_details.courier', $courier);
        session()->put('shipping_details.delivery_package', $deliveryPackage);
        session()->put('shipping_details.shipping_cost', $shippingCost);
        session()->put('shipping_details.total_price', $totalPrice);

        return response()->json([
            'shipping_fee' => number_format($shippingCost, 0, ',', '.'),
            'total_price' => number_format($totalPrice, 0, ',', '.'),
        ]);
    }

    // Menyimpan data pemesanan ke database
    public function store(Request $request) 
    {
        // Log data yang diterima
        Log::info('Data yang diterima di store:', $request->all());

        // Validasi input
        $request->validate([
            'delivery_date' => 'required|date',
            'notes' => 'nullable|string',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file
        ]);

        // Ambil data dari sesi
        $orderDetails = session()->get('order_details');
        $shippingDetails = session()->get('shipping_details');
        $selectedItems = session()->get('selected_items', []);

        // Cek apakah data sesi tersedia
        if (empty($selectedItems) && empty($orderDetails)) {
            Log::error('Order details or selected items missing from session');
            return redirect()->route('user.pemesanan')->with('error', 'Data pemesanan tidak lengkap.');
        }

        // Log data karakter yang dipilih sebelum menyimpan
        if (!empty($orderDetails)) {
            Log::info('Selected karakter data before saving order:', $orderDetails);
        }

        // Simpan order ke database
        $order = new Order();
        $order->user_id = auth()->id(); // Menggunakan ID pengguna yang sedang login
        $order->delivery_date = $request->input('delivery_date');
        $order->notes = $request->input('notes');
        $order->courier = $shippingDetails['courier'];
        $order->delivery_package = $shippingDetails['delivery_package'];
        $order->shipping_cost = $shippingDetails['shipping_cost'];
        $order->total_price = $shippingDetails['total_price'];
        $order->status = 'pending'; // Status awal pesanan

        // Jika ada bukti pembayaran, simpan file
        if ($request->hasFile('payment_proof')) {
            $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
            Log::info('Payment proof uploaded', ['file_path' => $filePath]);
            $order->payment_proof = $filePath;
        }

        // Simpan data order ke database
        $order->save();
        Log::info('Order saved successfully', ['order_id' => $order->id]);

        // Case 1: Data berasal dari keranjang
        if (!empty($selectedItems)) {
            foreach ($selectedItems as $item) {
                $jenisCokelat = JenisCokelat::find($item['jenis_cokelat_id']);
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->jenis_cokelat_id = $item['jenis_cokelat_id'];
                $orderItem->price = $jenisCokelat ? $jenisCokelat->harga : 0;
                $orderItem->save();
    
                foreach ($item['karakter_items'] as $karakterItem) {
                    $orderItemKarakter = new OrderItemKarakter();
                    $orderItemKarakter->order_item_id = $orderItem->id;
                    $orderItemKarakter->karakter_cokelat_id = $karakterItem['karakter_cokelat_id'];
                    $orderItemKarakter->quantity = (int) $karakterItem['quantity']; // Pastikan quantity dipindahkan
                    $orderItemKarakter->notes = $karakterItem['notes'] ?? ''; // Default catatan jika tidak ada
                    $orderItemKarakter->save();
                }
    
                // Hapus item dari tabel cart_items
                CartItem::where('id', $item['id'])->delete();
            }
    
            // Hapus keranjang jika tidak ada item yang tersisa
            $cart = Cart::where('user_id', auth()->id())->first();
            if ($cart && $cart->items()->count() == 0) {
                $cart->delete();
            }
        }
        // Case 2: Data berasal dari sesi pemesanan langsung
        if (!empty($orderDetails)) {
            $selectedJenis = $orderDetails['selected_jenis'];
            $selectedKarakter = $orderDetails['selected_karakter'];
    
            // Simpan data order item ke database
            $jenisCokelat = JenisCokelat::find($selectedJenis);
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->jenis_cokelat_id = $selectedJenis;
            $orderItem->price = $jenisCokelat ? $jenisCokelat->harga : 0;
            $orderItem->save();
    
            // Simpan data order item karakter ke database
            foreach ($selectedKarakter as $karakterId => $karakterDetail) {
                $orderItemKarakter = new OrderItemKarakter();
                $orderItemKarakter->order_item_id = $orderItem->id;
                $orderItemKarakter->karakter_cokelat_id = $karakterId;
                $orderItemKarakter->quantity = (int)($karakterDetail['jumlah'] ?? 1); // Pastikan ini adalah integer
                $orderItemKarakter->notes = $karakterDetail['catatan'] ?? ''; // Default catatan jika tidak ada
                $orderItemKarakter->save();
            }
        }

        // Hapus data sesi setelah menyimpan
        session()->forget('order_details');
        session()->forget('shipping_details');
        session()->forget('selected_items');

        // Kembalikan respons JSON dengan pesan sukses
        return response()->json(['success' => 'Pesanan berhasil dibuat!']);
    }

    public function clearSession(Request $request)
    {
        session()->forget(['selected_items', 'order_details', 'shipping_details']);
        
        // Log session data after clearing
        \Log::info('Session data after clearing:', session()->all());
        
        return response()->json(['status' => 'Session cleared']);
    }
}
