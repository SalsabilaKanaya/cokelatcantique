<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            \Log::info('User is authenticated in middleware', [
                'user' => Auth::user(),
                'session_id' => session()->getId(),
                'user_id' => Auth::id()
            ]);
        } else {
            \Log::warning('User is not authenticated in middleware');
        }
    
        return $next($request);    
    }
}
