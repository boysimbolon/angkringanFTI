<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('login_as');
        if ($token == 'bendahara' || $token == 'serving') {
            return $next($request);
        }else{
            Session::flush();
            return redirect()->route('login')->with('message', 'Anda tidak penjual Ankringan FTI.');
        }
    }
}
