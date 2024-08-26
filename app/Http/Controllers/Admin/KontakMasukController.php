<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\KontakController;
use App\Models\Kontak;
use App\Http\Controllers\Controller;

class KontakMasukController extends Controller
{
    public function index()
    {
        $kontak = Kontak::all(); // mengambail semua data kontak
        return view('admin.kontak', compact('kontak'));
    }
}
