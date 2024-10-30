<?php

namespace App\Http\Controllers\User;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function beranda()
    {
        // Mengambil data testimoni yang statusnya publish dari database
        $testimoniss = Testimoni::where('status', 'publish')->get();
        // Mengirim data testimoni ke view beranda
        return view('user.beranda', compact('testimoniss'));
    }
    
    public function tentang()
    {
        return view('user.tentang');
    }

    public function giftIdea()
    {
        return view('user.gift_idea');
    }

    public function faq()
    {
        return view('user.faq');
    }

    public function caraPemesanan()
    {
        return view('user.cara_pemesanan');
    }

    public function keranjang()
    {
        return view('user.keranjang');
    }
}
