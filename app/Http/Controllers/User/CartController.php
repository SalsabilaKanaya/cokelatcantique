<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemKarakter;
use App\Models\JenisCokelat;
use App\Models\KarakterCokelat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function showCart()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Cari keranjang berdasarkan user ID
        $cart = Cart::where('user_id', $userId)
                    ->with('items.karakterItems.karakterCokelat')
                    ->orderBy('created_at', 'desc')
                    ->first();

        // Pass data keranjang ke view
        return view('user.keranjang', compact('cart'));
    }

    public function cartProcess(Request $request)
    {
        // Cek user address
        // Ambil data pengguna yang sedang login
        $user = auth()->user();

        // Cek apakah pengguna memiliki alamat yang terdaftar
        $userAddress = $user->userAddress;

        // Debugging: Tampilkan data alamat
        if ($userAddress && $userAddress->address) {
            // Alamat lengkap, lanjutkan proses
        } else {
            // Jika alamat tidak lengkap atau tidak ada, redirect ke halaman profil
            return redirect()->route('user.profil', ['#alamat'])->with('message', 'Silakan lengkapi alamat Anda.');
        }

        $userId = Auth::id();
        $selectedItems = $request->input('selected_items', []);

        // Log the selected items received from the request
        \Log::info('Selected items received:', ['items' => $selectedItems]);

        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'Tidak ada item yang dipilih.');
        }

        $cart = Cart::where('user_id', $userId)->with('items.karakterItems.karakterCokelat')->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
        }

        // Filter items based on the selected items
        $filteredItems = $cart->items->filter(function ($item) use ($selectedItems) {
            return in_array($item->id, $selectedItems);
        });

        // Log the filtered items
        \Log::info('Filtered items:', ['items' => $filteredItems->toArray()]);

        if ($filteredItems->isEmpty()) {
            return redirect()->back()->with('error', 'Item yang dipilih tidak ditemukan.');
        }

        // Prepare the data to be stored in the session
        $sessionData = $filteredItems->map(function ($item) {
            return [
                'id' => $item->id,
                'cart_id' => $item->cart_id,
                'jenis_cokelat_id' => $item->jenis_cokelat_id,
                'price' => $item->price,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'karakter_items' => $item->karakterItems->map(function ($karakterItem) {
                    return [
                        'karakter_cokelat_id' => $karakterItem->karakter_cokelat_id,
                        'quantity' => $karakterItem->quantity, // Pastikan quantity disimpan
                        'notes' => $karakterItem->notes,
                    ];
                })->toArray(),
            ];
        })->toArray();

        // Debugging output
        \Log::info('Redirecting to pemesanan', ['sessionData' => $sessionData]);

        // Flash the filtered items to the session
        session()->put('selected_items', $sessionData);
        \Log::info('Session data after putting selected_items:', session()->all());

        // Redirect to the pemesanan page
        return redirect()->route('user.pemesanan');
    }
    
    public function deleteItem(Request $request)
    {
        $userId = Auth::id();
        $itemId = $request->input('item_id');

        // Cari item di keranjang berdasarkan ID item dan ID user
        $cartItem = CartItem::where('id', $itemId)->whereHas('cart', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->first();

        if ($cartItem) {
            // Hapus karakter item terkait
            CartItemKarakter::where('cart_item_id', $cartItem->id)->delete();

            // Hapus item dari keranjang
            $cartItem->delete();

            return response()->json(['success' => true, 'message' => 'Item berhasil dihapus dari keranjang.']);
        }

        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan di keranjang.']);
    }
}