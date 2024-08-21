<?php

namespace App\Http\Controllers\User;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{

    public function edit()
    {
        $user = Auth::user();
        \Log::info('User data for edit', [
            'user_id' => $user->id,
            'user_address' => $user->user_address,
        ]);
        return view('user.edit_alamat', compact('user'));
    }
    

    public function update(Request $request)
    {
        $user = Auth::user();
        $address = $user->user_address ?? new \App\Models\UserAddress();
    
        // Fetch province and city names from RajaOngkir API
        $provinceResponse = Http::withHeaders([
            'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
        ])->get('https://api.rajaongkir.com/starter/province', [
            'id' => $request->input('province_id')
        ]);
    
        $cityResponse = Http::withHeaders([
            'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
        ])->get('https://api.rajaongkir.com/starter/city', [
            'id' => $request->input('city_id')
        ]);
    
        $provinceName = $provinceResponse->json()['rajaongkir']['results']['province'];
        $cityName = $cityResponse->json()['rajaongkir']['results']['city_name'];
    
        // Fill the address model with request data and fetched names
        $address->fill([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'province_id' => $request->input('province_id'),
            'city_id' => $request->input('city_id'),
            'province_name' => $provinceName,
            'city_name' => $cityName,
            'address' => $request->input('address'),
        ]);
    
        $address->user_id = $user->id;
        $address->save();
    
        \Log::info('Address updated', [
            'user_id' => $user->id,
            'address' => $address->toArray(),
        ]);
    
        return redirect()->route('user.profil', ['#alamat'])->with('success', 'Address updated successfully.');
    }
    

    public function getProvinces()
    {
        try {
            $response = Http::withHeaders([
                'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
            ])->get('https://api.rajaongkir.com/starter/province');

            // Log response for debugging
            \Log::info('RajaOngkir API response', $response->json());

            if ($response->successful()) {
                return response()->json($response->json()['rajaongkir']['results']);
            } else {
                return response()->json(['error' => 'Failed to fetch provinces'], $response->status());
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching provinces', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function getCities($provinceId)
    {
        try {
            $response = Http::withHeaders([
                'key' => 'f587d9fb3201bbc06ed11b0116fe4b56',
            ])->get('https://api.rajaongkir.com/starter/city', [
                'province' => $provinceId
            ]);

            // Log response for debugging
            \Log::info('RajaOngkir API response', $response->json());

            if ($response->successful()) {
                return response()->json($response->json()['rajaongkir']['results']);
            } else {
                return response()->json(['error' => 'Failed to fetch cities'], $response->status());
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching cities', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

}
