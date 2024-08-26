<?php

namespace App\Http\Controllers\User;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    // Method untuk menampilkan halaman profil pengguna
    public function profil()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Memuat relasi 'userAddress' untuk pengguna
        $user->load('userAddress'); // Load relasi untuk user_address, province, dan city

        // Mengirim data pengguna ke view profil
        return view('user.profil', compact('user'));
    }

    // Method untuk menampilkan halaman edit profil pengguna
    public function editProfil()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Mengirim data pengguna ke view edit_profil
        return view('user.edit_profil', compact('user'));
    }

    // Method untuk memperbarui data profil pengguna
    public function updateProfil(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:male,female',
            'datebirth' => 'required|date',
        ]);

        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Update data pengguna berdasarkan input yang diterima
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->datebirth = $request->input('datebirth');
        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('user.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}