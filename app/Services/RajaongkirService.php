<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaongkirService
{
    protected $apiKey = 'f587d9fb3201bbc06ed11b0116fe4b56';

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.api_key');
    }

    // public function getProvinces()
    // {
    //     $response = Http::withHeaders([
    //         'key' => $this->apiKey,
    //     ])->get('https://api.rajaongkir.com/starter/province');

    //     return $response->json();
    // }

    // public function getCities($provinceId)
    // {
    //     $response = Http::withHeaders([
    //         'key' => $this->apiKey,
    //     ])->get('https://api.rajaongkir.com/starter/city', [
    //         'province' => $provinceId
    //     ]);

    //     return $response->json();
    // }

    public function getShippingCost($origin, $destination, $weight, $courier)
{
    $url = 'https://api.rajaongkir.com/starter/cost';
    $apiKey = env('RAJAONGKIR_API_KEY');

    $response = Http::withHeaders([
        'key' => $apiKey
    ])->post($url, [
        'origin' => $origin,
        'destination' => $destination,
        'weight' => $weight,
        'courier' => $courier
    ]);
    
    if ($response->failed()) {
        \Log::error('API request failed with status: ' . $response->status());
    }
    
    return $response->json();
}

}

