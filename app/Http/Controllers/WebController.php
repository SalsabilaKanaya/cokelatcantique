<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function beranda()
    {
        $testimonis = Testimoni::all();
        \Log::info('Data Testimoni:', $testimonis->toArray());
        return view('beranda', compact('testimonis')); 
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
