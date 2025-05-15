<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {

            $rolesArray = explode(',', $role);

            if (!Auth::check()) {
                return redirect()->intended('/login');
            } elseif (Auth::user()->role === 'admin') {
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

