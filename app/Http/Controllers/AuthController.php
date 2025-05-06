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

            if (!Auth::user()->active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda nonaktif.']);
            }
            
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
        return view('be.userstable.users', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    // Menampilkan view create user
    public function createUserPage()
    {
        return view('be.userstable.usercreate');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,marketing,ceo',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->intended('/users')->with('success', 'User created successfully.');
    }

    public function editUserPage($id)
    {
        $user = User::findOrFail($id);
        return view('be.userstable.userupdate', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,marketing,ceo',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();


        return redirect()->route('users')->with('success', 'User updated successfully.');
    }


    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();
        return back()->with('success', 'User status updated successfully.');
    }


}
