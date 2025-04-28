<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,marketing,ceo',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return redirect('/login');

        return back()->withErrors(['email' => 'Email atau password salah']);
        return back()->withErrors(['password' => 'Pastikan password minimal 8 karakter']);

    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // return redirect()->intended('/dashboard');
            if ($request->user()->role === 'admin') {
                return redirect()->intended('/admin');
            } elseif ($request->user()->role === 'marketing') {
                return redirect()->intended('/marketing');
            } elseif ($request->user()->role === 'ceo') {
                return redirect()->intended('/ceo');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->back();
        // return redirect()->intended('/login');
    }

    public function updateUserPage()
    {
        $users = User::all(); // Fetch all users
        return view('be.admin.userupdate', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
