<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function page_daftar()
    {
        return view('auth.daftar',[

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function daftar(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggan',
            'katakunci' => 'required|string|min:8|max:15|confirmed',
            'no_telp' => 'required|string|max:15',
            // 'alamat1' => 'string|max:255',
            // 'kota1' => 'string|max:255',
            // 'propinsi1' => 'string|max:255',
            // 'kodepos1' => 'string|max:255',
            // 'alamat2' => 'string|max:255',
            // 'kota2' => 'string|max:255',
            // 'propinsi2' => 'string|max:255',
            // 'kodepos2' => 'string|max:255',
            // 'alamat3' => 'string|max:255',
            // 'kota3' => 'string|max:255',
            // 'propinsi3' => 'string|max:255',
            // 'kodepos3' => 'string|max:255',
            // 'foto' => 'required|string',

        ]);

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email' => $request->email,
            'katakunci' => Hash::make($request->katakunci),
            'no_telp' => $request->no_telp,
            // 'alamat1' => $request->alamat1,
            // 'kota1' => $request->kota1,
            // 'propinsi1' => $request->propinsi1,
            // 'kodepos1' => $request->kodepos1,
            // 'alamat2' => $request->alamat2,
            // 'kota2' => $request->kota2,
            // 'propinsi2' => $request->propinsi2,
            // 'kodepos2' => $request->kodepos2,
            // 'alamat3' => $request->alamat3,
            // 'kota3' => $request->kota3,
            // 'propinsi3' => $request->propinsi3,
            // 'kodepos3' => $request->kodepos3,
            // 'foto' => $request->foto,

            // 'alamat1' => null,
            // 'kota1' => null,
            // 'propinsi1' => null,
            // 'kodepos1' => null,
            // 'alamat2' => null,
            // 'kota2' => null,
            // 'propinsi2' => null,
            // 'kodepos2' => null,
            // 'alamat3' => null,
            // 'kota3' => null,
            // 'propinsi3' => null,
            // 'kodepos3' => null,
            // 'foto' => null,
        ]);

        Auth::login($pelanggan);

        return redirect('/masuk');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function page_masuk()
    {
        return view('auth.masuk');
    }

    /**
     * Display the specified resource.
     */
    public function masuk(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'katakunci' => 'required'
        ]);

        // if (Auth::guard('pelanggan')->attempt(['email' => $credentials['email'], 'password' => $credentials['katakunci']])) {
        //     return redirect()->intended('/');
        // }

        if (Auth::guard('pelanggan')->attempt(['email' => $credentials['email'], 'password' => $credentials['katakunci']])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function keluar()
    {
        Auth::guard('pelanggan')->logout();
        return redirect()->back();
    }

    public function profilePelanggan() {
        return view('fe.profile.profile', [
            'title' => 'Profile',
            'pelanggan' => Pelanggan::where('id', Auth::guard('pelanggan')->user()->id)->first()
        ]);
    }
}
