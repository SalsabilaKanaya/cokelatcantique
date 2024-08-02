<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function beranda()
    {
        return view('beranda');
    }
    
    public function testimoni()
    {
        $testimonis = Testimoni::all();
        return view('beranda', compact('testimonis'));
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function gift_idea()
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
}
