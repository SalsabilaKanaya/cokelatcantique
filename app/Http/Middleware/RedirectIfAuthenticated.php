<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Tambahkan log untuk debug
        \Log::info('RedirectIfAuthenticated middleware called', [
            'user' => Auth::user(),
            'url' => $request->url()
        ]);

        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
} 
