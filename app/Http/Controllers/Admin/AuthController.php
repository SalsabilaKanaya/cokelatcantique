<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LoginAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login_admin'); // Mengarahkan ke view login_admin.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = LoginAdmin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}








// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\LoginAdmin;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class AuthController extends Controller
// {
//     public function showLoginForm()
//     {
//         return view('login_admin'); // Mengarahkan ke view login_admin.blade.php
//     }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'username' => 'required',
//             'password' => 'required',
//         ]);

//         $admin = LoginAdmin::where('username', $request->username)->first();

//         if ($admin && Hash::check($request->password, $admin->password)) {
//             Auth::login($admin);
//             return redirect()->intended('dashboard');
//         }

//         return back()->withErrors([
//             'username' => 'The provided credentials do not match our records.',
//         ]);
//     }
// }