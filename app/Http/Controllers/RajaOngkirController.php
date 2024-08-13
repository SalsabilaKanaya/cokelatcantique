<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Services\RajaongkirService;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    protected $rajaongkirService;

    public function __construct(RajaongkirService $rajaongkirService)
    {
        $this->rajaongkirService = $rajaongkirService;
    }

    public function getProvinces()
    {
        $response = Http::withHeaders(['key' => 'f587d9fb3201bbc06ed11b0116fe4b56'])
            ->get('https://api.rajaongkir.com/starter/province');

        // Mengambil data JSON dari respons
        $data = $response->json();

        // Cek apakah kunci 'rajaongkir' ada di data
        if (isset($data['rajaongkir']) && isset($data['rajaongkir']['results'])) {
            $provinces = $data['rajaongkir']['results'];
            // Mengembalikan data provinsi dengan format yang diharapkan
            return response()->json($provinces);
        } else {
            // Tangani jika data tidak sesuai atau tidak ada
            return response()->json(['error' => 'Data tidak tersedia atau format tidak sesuai'], 500);
        }
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders(['key' => 'f587d9fb3201bbc06ed11b0116fe4b56'])
            ->get("https://api.rajaongkir.com/starter/city?province=$provinceId");
    
        $data = $response->json();
    
        // Periksa apakah kunci 'rajaongkir' dan 'results' ada di data
        if (isset($data['rajaongkir']) && isset($data['rajaongkir']['results'])) {
            $cities = $data['rajaongkir']['results'];
            return response()->json($cities);
        } else {
            return response()->json(['error' => 'Data tidak tersedia atau format tidak sesuai'], 500);
        }
    }
    
}
