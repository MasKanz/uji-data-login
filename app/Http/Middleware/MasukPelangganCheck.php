<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MasukPelangganCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('pelanggan')->check()) {

            if (!Auth::guard('pelanggan')->user()->active) {
                Auth::guard('pelanggan')->logout();
                return back()->withErrors(['email' => 'Your account is nonactive.']);
            }

            // return redirect()->back();
            return redirect()->intended('/profilepelanggan');
        }
        return $next($request);
    }
}
