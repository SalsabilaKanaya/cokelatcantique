<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaongkirService
{
    protected $apiKey = 'f587d9fb3201bbc06ed11b0116fe4b56';

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get('https://api.rajaongkir.com/starter/province');

        return $response->json();
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $provinceId
        ]);

        return $response->json();
    }

    public function getShippingCost($origin, $destination, $weight, $courier)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return $response->json();
    }
}
