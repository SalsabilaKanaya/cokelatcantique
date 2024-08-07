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
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Autentikasi pengguna
        if (Auth::attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ])) {
            // Redirect atau response jika login berhasil
            return redirect()->route('beranda'); // Ganti dengan route yang sesuai
        }

        // Redirect atau response jika login gagal
        return redirect()->back()->withErrors([
            'login_error' => 'Email atau password salah.',
        ]);
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
