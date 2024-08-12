<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function beranda()
    {
        // Mengambil data testimoni dari database
        $testimoniss = Testimoni::all();
        // Mengirim data testimoni ke view beranda
        return view('beranda', compact('testimoniss'));
    }
    
    public function tentang()
    {
        return view('tentang');
    }

    public function giftIdea()
    {
        return view('gift_idea');
    }

    public function faq()
    {
        return view('faq');
    }

    public function caraPemesanan()
    {
        return view('cara_pemesanan');
    }

    public function histori()
    {
        return view('histori');
    }

    public function keranjang()
    {
        return view('keranjang');
    }
}
