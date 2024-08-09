<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
   public function beranda()
    {
        \Log::info('Beranda method called');
        
        if (Auth::check()) {
            \Log::info('User authenticated', [
                'user' => Auth::user(),
                'session_id' => session()->getId(),
                'user_id' => Auth::id()
            ]);
        } else {
            \Log::warning('User not authenticated');
        }
        
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
