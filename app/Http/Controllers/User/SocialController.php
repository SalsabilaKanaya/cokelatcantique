<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

     // Method untuk callback setelah login Google
    public function googleCallback()
     {
         $googleUser = Socialite::driver('google')->user();
     
         // Cari pengguna berdasarkan email di database lokal
         $user = User::where('email', $googleUser->email)->first();
     
         if ($user) {
             // Login pengguna ke aplikasi dengan guard default (web)
             Auth::guard('web')->login($user);
             return redirect()->route('user.beranda'); // Arahkan ke halaman beranda setelah login
         } else {
             // Jika pengguna tidak ditemukan, Anda bisa membuat pengguna baru atau menampilkan pesan
             $user = User::create([
                 'name' => $googleUser->name,
                 'email' => $googleUser->email,
                 'password' => bcrypt('password') // Anda bisa menggunakan password default atau generate password
             ]);
             
             // Login pengguna ke aplikasi dengan guard default (web)
             Auth::guard('web')->login($user);
             return redirect()->route('user.beranda'); // Arahkan ke halaman beranda setelah login
         }
     }

    public function logout(Request $request)
    {
         // Hapus data karakter dan jenis cokelat dari sesi
         $request->session()->forget('selected_karakter');
         $request->session()->forget('selected_jenis'); 
     
         // Logout pengguna
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         
         // Redirect ke halaman login
         return redirect()->route('user.login'); // Pastikan rute ini sesuai dengan nama rute untuk login
    }
}
