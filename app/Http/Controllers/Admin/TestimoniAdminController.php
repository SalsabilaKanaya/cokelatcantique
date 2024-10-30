<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniAdminController extends Controller
{
    public function index()
    {
        // Ambil semua testimoni dari database
        $testimoni = Testimoni::orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(6);
        return view('admin.testimoni', compact('testimoni'));
    }

    public function publish($id)
    {
        \Log::info("Mencoba mempublikasikan testimoni ID: {$id}");
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->status = 'publish'; // Ubah status menjadi published
        $testimoni->save();

        \Log::info("Testimoni ID {$id} telah dipublikasikan.");
        return response()->json(['status' => 'success']);
    }

    public function reject($id)
    {
        \Log::info("Mencoba menolak testimoni ID: {$id}");
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->status = 'tolak'; // Ubah status menjadi rejected
        $testimoni->save();

        \Log::info("Testimoni ID {$id} telah ditolak.");
        return response()->json(['status' => 'success']);
    }
}