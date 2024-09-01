<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info('CheckSession middleware triggered.');
        
        if (!Auth::check() && !$request->session()->has('user_id')) {
            // Jika sesi telah habis, tambahkan pesan ke sesi
            Log::info('Session expired for user.');
            $request->session()->flash('session_expired', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        return $next($request);
    }
}