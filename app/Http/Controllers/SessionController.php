<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function clearSession(Request $request)
    {
        Log::info('clearSession method called'); // Tambahkan log untuk debugging
        Session::flush();
        return response()->json(['status' => 'Session cleared']);
    }
}