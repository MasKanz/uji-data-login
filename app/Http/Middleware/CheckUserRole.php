<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {

        if (!Auth::check()) {
            return redirect()->intended('/login');
        }

        $userRole = Auth::user()->role;
        $allowedRoles = array_map('trim', $roles);


        // Debug output
        // Hapus komentar untuk melihat hasil di browser
        // dd($userRole, $allowedRoles, $roles, Auth::user());

        if (!in_array($userRole, $allowedRoles)) {
            return back();
        }

        return $next($request);
    }
}

