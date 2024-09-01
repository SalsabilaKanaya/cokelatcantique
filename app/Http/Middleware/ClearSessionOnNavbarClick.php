<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearSessionOnNavbarClick
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna berada di halaman pemesanan
        if ($request->is('pemesanan')) {
            // Cek apakah pengguna mengklik bagian navbar
            if ($request->query('navbar_click')) {
                session()->forget('selected_items');
                session()->forget('order_details');
            }
        }

        return $next($request);
    }
}