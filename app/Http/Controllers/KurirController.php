<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RajaongkirService;
use Illuminate\Support\Facades\Log;

class KurirController extends Controller
{
    protected $rajaongkirService;

    public function __construct(RajaongkirService $rajaongkirService)
    {
        $this->rajaongkirService = $rajaongkirService;
    }

    public function getCouriers()
    {
        try {
            $response = $this->rajaongkirService->getCouriers();
            Log::info('Courier response:', ['response' => $response]);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Error fetching couriers: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching couriers'], 500);
        }
    }
}
