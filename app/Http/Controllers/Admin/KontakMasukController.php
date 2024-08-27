<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakMasukController extends Controller
{
    public function index()
    {
        // Mengambil semua data kontak dan mengurutkannya dari yang terbaru ke terlama
        $kontak = Kontak::orderBy('created_at', 'desc')->get();
        return view('admin.kontak', compact('kontak'));
    }

    public function markAsRead($id)
    {
        $kontak = Kontak::findOrFail($id); // Mencari data kontak berdasarkan ID
        $kontak->status = 'read'; // Mengubah status menjadi 'read'
        $kontak->save(); // Menyimpan perubahan ke database

        return response()->json(['status' => 'success']); // Mengirimkan response JSON
    }
}
