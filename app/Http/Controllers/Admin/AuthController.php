<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LoginAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Menampilkan form login untuk admin
    public function showLoginForm()
    {
        return view('admin.login_admin'); // Mengarahkan ke view login_admin.blade.php
    }

    // Proses autentikasi login admin
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = LoginAdmin::where('username', $request->username)->first(); // Mencari admin berdasarkan username

        // Memeriksa apakah admin ditemukan dan password yang diberikan cocok
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin); // Melakukan login untuk admin
            return redirect()->intended(route('admin.dashboard')); // Mengarahkan ke dashboard admin
        }

        // Jika kredensial tidak cocok, mengarahkan kembali dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    // Proses logout admin
    public function logout(Request $request)
    {
        Auth::logout(); // Melakukan logout
        $request->session()->invalidate(); // Menghapus sesi
        $request->session()->regenerateToken(); // Menghasilkan ulang token sesi untuk keamanan

        return redirect()->route('admin.login'); // Mengarahkan kembali ke halaman login
    }

}
