<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakMasukController extends Controller
{
    public function index()
    {
        // Mengambil data kontak dengan pagination dan mengurutkannya berdasarkan status dan waktu pembuatan
        $kontak = Kontak::orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(6); // 10 item per halaman
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