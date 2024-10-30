<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Pastikan ini ada
use App\Http\Controllers\Controller;

class TestimoniController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Store method called'); // Tambahkan log
        Log::info('Request data: ', $request->all());
        // Validasi input
        $request->validate([
            'review' => 'required|string|max:255',
        ]);

        Log::info('Validation passed'); // Log jika validasi berhasil

        // Simpan data testimoni ke database
        Testimoni::create([
            'nama' => Auth::user()->name,
            'isi_testimoni' => $request->review,
        ]);

        Log::info('Testimoni saved successfully'); // Log jika berhasil disimpan

        // Kembalikan respons JSON
        return response()->json(['success' => 'Ulasan berhasil dikirim!']);
    }
}