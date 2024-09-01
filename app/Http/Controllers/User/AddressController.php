<?php

namespace App\Http\Controllers\User;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    // Method untuk menampilkan halaman create alamat pengguna
    public function create()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Mengirim data pengguna ke view 'user.create_alamat'
        return view('user.create_alamat', compact('user'));
    }

    // Method untuk menyimpan alamat baru pengguna
    public function store(Request $request)
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Mengambil nama provinsi dari API RajaOngkir
        $provinceResponse = Http::withHeaders([
            'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
        ])->get('https://api.rajaongkir.com/starter/province', [
            'id' => $request->input('province_id')
        ]);
    
        // Mengambil nama kota dari API RajaOngkir
        $cityResponse = Http::withHeaders([
            'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
        ])->get('https://api.rajaongkir.com/starter/city', [
            'id' => $request->input('city_id')
        ]);
    
        // Mengambil nama provinsi dari respons API
        $provinceName = $provinceResponse->json()['rajaongkir']['results']['province'];

        // Mengambil nama kota dari respons API
        $cityName = $cityResponse->json()['rajaongkir']['results']['city_name'];
    
        // Membuat instance baru dari UserAddress
        $address = new UserAddress();
        $address->fill([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'province_id' => $request->input('province_id'),
            'city_id' => $request->input('city_id'),
            'province_name' => $provinceName,
            'city_name' => $cityName,
            'address' => $request->input('address'),
        ]);
    
        // Menetapkan ID pengguna untuk alamat tersebut
        $address->user_id = $user->id;

        // Menyimpan alamat baru ke database
        $address->save();
    
        // Logging informasi alamat yang dibuat untuk debugging
        \Log::info('Address created', [
            'user_id' => $user->id,
            'address' => $address->toArray(),
        ]);
    
        // Mengarahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('user.profil', ['#alamat'])->with('success', 'Address created successfully.');
    }

    // Method untuk menampilkan halaman edit alamat pengguna
    public function edit()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Logging informasi pengguna untuk debugging
        \Log::info('User data for edit', [
            'user_id' => $user->id,
            'user_address' => $user->userAddress,
        ]);

        // Mengirim data pengguna ke view 'user.edit_alamat'
        return view('user.edit_alamat', compact('user'));
    }
    
    // Method untuk mengupdate alamat pengguna
    public function update(Request $request)
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Mengambil data alamat pengguna atau membuat instance baru jika belum ada
        $address = $user->userAddress ?? new \App\Models\UserAddress();
    
        // Mengambil nama provinsi dari API RajaOngkir
        $provinceResponse = Http::withHeaders([
            'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
        ])->get('https://api.rajaongkir.com/starter/province', [
            'id' => $request->input('province_id')
        ]);
    
        // Mengambil nama kota dari API RajaOngkir
        $cityResponse = Http::withHeaders([
            'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
        ])->get('https://api.rajaongkir.com/starter/city', [
            'id' => $request->input('city_id')
        ]);
    
        // Mengambil nama provinsi dari respons API
        $provinceName = $provinceResponse->json()['rajaongkir']['results']['province'];

        // Mengambil nama kota dari respons API
        $cityName = $cityResponse->json()['rajaongkir']['results']['city_name'];
    
        // Mengisi model alamat dengan data dari input pengguna dan nama provinsi serta kota yang didapat dari API
        $address->fill([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'province_id' => $request->input('province_id'),
            'city_id' => $request->input('city_id'),
            'province_name' => $provinceName,
            'city_name' => $cityName,
            'address' => $request->input('address'),
        ]);
    
        // Menetapkan ID pengguna untuk alamat tersebut
        $address->user_id = $user->id;

        // Menyimpan perubahan ke database
        $address->save();
    
        // Logging informasi alamat yang diperbarui untuk debugging
        \Log::info('Address updated', [
            'user_id' => $user->id,
            'address' => $address->toArray(),
        ]);
    
        // Mengarahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('user.profil', ['#alamat'])->with('success', 'Address updated successfully.');
    }
    
    // Method untuk mengambil daftar provinsi dari API RajaOngkir
    public function getProvinces()
    {
        try {
            // Mengirim permintaan ke API RajaOngkir untuk mengambil data provinsi
            $response = Http::withHeaders([
                'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
            ])->get('https://api.rajaongkir.com/starter/province');

            // Logging respons API untuk debugging
            \Log::info('RajaOngkir API response', $response->json());

            // Jika respons berhasil, mengirim data provinsi dalam format JSON
            if ($response->successful()) {
                return response()->json($response->json()['rajaongkir']['results']);
            } else {
                // Jika terjadi kegagalan, kirim pesan error dengan status respons dari API
                return response()->json(['error' => 'Failed to fetch provinces'], $response->status());
            }
        } catch (\Exception $e) {
            // Logging error jika terjadi exception saat mengambil data
            \Log::error('Error fetching provinces', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    // Method untuk mengambil daftar kota berdasarkan ID provinsi dari API RajaOngkir
    public function getCities($provinceId)
    {
        try {
            // Mengirim permintaan ke API RajaOngkir untuk mengambil data kota berdasarkan provinsi
            $response = Http::withHeaders([
                'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
            ])->get('https://api.rajaongkir.com/starter/city', [
                'province' => $provinceId
            ]);

            // Logging respons API untuk debugging
            \Log::info('RajaOngkir API response', $response->json());

            // Jika respons berhasil, mengirim data kota dalam format JSON
            if ($response->successful()) {
                return response()->json($response->json()['rajaongkir']['results']);
            } else {
                // Jika terjadi kegagalan, kirim pesan error dengan status respons dari API
                return response()->json(['error' => 'Failed to fetch cities'], $response->status());
            }
        } catch (\Exception $e) {
            // Logging error jika terjadi exception saat mengambil data
            \Log::error('Error fetching cities', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}