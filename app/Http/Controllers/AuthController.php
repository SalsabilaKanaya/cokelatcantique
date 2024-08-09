<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AkunUser;

class AuthController extends Controller
{
    // Tampilkan formulir login
    public function showLoginForm()
    {
        return view('login'); // Pastikan ini adalah nama file view login Anda
    }

    // Login method
    // app/Http/Controllers/AuthController.php
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            $user = Auth::user();
            \Log::info('Login successful', ['user' => $user]);
            
            // Redirect ke halaman yang sesuai
            return redirect()->route('beranda');
        } else {
            // Login gagal
            \Log::warning('Login failed', ['credentials' => $credentials]);
            return redirect()->back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }


    // Register method
    public function register(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'email' => 'required|string|email|max:255|unique:akun_user,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Buat pengguna baru
        $user = AkunUser::create([
            'name' => $request->input('name'),
            'no_telp' => $request->input('no_telp'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Redirect atau response setelah pendaftaran berhasil
        return redirect()->route('login')->with('status', 'Registrasi berhasil, silakan login.');
    }
}
