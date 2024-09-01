<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    // Method untuk redirect ke halaman login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Method untuk menangani callback setelah login menggunakan Google
    public function googleCallback()
    {
        // Mendapatkan data pengguna dari Google
        $googleUser = Socialite::driver('google')->user();
     
        // Mencari pengguna di database lokal berdasarkan email
        $user = User::where('email', $googleUser->email)->first();
     
        if ($user) {
            // Jika pengguna ditemukan, login pengguna
            Auth::guard('web')->login($user);

            // Redirect ke halaman beranda setelah login
            return redirect()->route('user.beranda');
        } else {
            // Jika pengguna tidak ditemukan, buat pengguna baru
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt('password') // Set password default atau generate password
            ]);
             
            // Login pengguna baru
            Auth::guard('web')->login($user);

            // Redirect ke halaman beranda setelah login
            return redirect()->route('user.beranda');
        }
    }

    // Method untuk login dengan email
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('user.login')->withErrors(['email' => 'Akun belum tersedia, harap lakukan registrasi terlebih dahulu.']);
        }

        // Coba login dengan kredensial
        if (Auth::attempt($credentials)) {
            return redirect()->route('user.beranda');
        }

        return redirect()->route('user.login')->withErrors(['email' => 'Email atau password salah.']);
    }
    
    // Method untuk registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout(Request $request)
    {
        // Hapus sesi yang spesifik
        session()->forget(['selected_items', 'order_details', 'shipping_details']);
        
        // Log session data after clearing
        \Log::info('Session data after clearing:', session()->all());
        
        // Hapus semua data session
        Session::flush();
        
        // Periksa apakah session sudah kosong
        if (empty(session()->all())) {
            // Session berhasil dihapus
            $sessionCleared = true;
        } else {
            // Session tidak berhasil dihapus
            $sessionCleared = false;
        }
        
        // Logout pengguna
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke halaman login
        return redirect()->route('user.login'); // Pastikan rute ini sesuai dengan nama rute untuk login
    }
}