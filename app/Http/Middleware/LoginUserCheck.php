<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class LoginUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin');
            } elseif (Auth::user()->role === 'marketing') {
                return redirect()->intended('/marketing');
            } elseif (Auth::user()->role === 'ceo') {
                return redirect()->intended('/ceo');
            }
        }

        return $next($request);
    }
}
