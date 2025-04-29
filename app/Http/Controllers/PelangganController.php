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

        ]);

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email' => $request->email,
            'katakunci' => Hash::make($request->katakunci),
            'no_telp' => $request->no_telp,

        ]);

        Auth::login($pelanggan);

        $credentials = $request->validate([
            'email' => 'required|email',
            'katakunci' => 'required'
        ]);

        if (Auth::guard('pelanggan')->attempt(['email' => $credentials['email'], 'password' => $credentials['katakunci']])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect('/home');

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


    public function updatePage() {
        return view('fe.profile.updatealamat', [
            'title' => 'Update Alamat'
        ]);
    }

    public function updateAlamat(Request $request)
    {
        /** @var \App\Models\Pelanggan $pelanggan */
        $request->validate([
            'alamat1' => 'nullable|string|max:255',
            'kota1' => 'nullable|string|max:255',
            'propinsi1' => 'nullable|string|max:255',
            'kodepos1' => 'nullable|string|max:20',

            'alamat2' => 'nullable|string|max:255',
            'kota2' => 'nullable|string|max:255',
            'propinsi2' => 'nullable|string|max:255',
            'kodepos2' => 'nullable|string|max:20',

            'alamat3' => 'nullable|string|max:255',
            'kota3' => 'nullable|string|max:255',
            'propinsi3' => 'nullable|string|max:255',
            'kodepos3' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,svg',
        ]);

        /** @var \App\Models\Pelanggan $pelanggan */
        $pelanggan = Auth::guard('pelanggan')->user();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_pelanggan', 'public');
            $pelanggan->foto = $path;
        }

        $pelanggan->update([
            'alamat1' => $request->alamat1,
            'kota1' => $request->kota1,
            'propinsi1' => $request->propinsi1,
            'kodepos1' => $request->kodepos1,
            'alamat2' => $request->alamat2,
            'kota2' => $request->kota2,
            'propinsi2' => $request->propinsi2,
            'kodepos2' => $request->kodepos2,
            'alamat3' => $request->alamat3,
            'kota3' => $request->kota3,
            'propinsi3' => $request->propinsi3,
            'kodepos3' => $request->kodepos3,
        ]);

        return redirect()->intended('/profilepelanggan')->with('success', 'Data alamat berhasil diperbarui!');
    }


    public function profilePelanggan() {
        return view('fe.profile.profile', [
            'title' => 'Profile',
            'pelanggan' => Pelanggan::where('id', Auth::guard('pelanggan')->user()->id)->first()
        ]);
    }

    public function showPelangganPage() {
        $pelanggans = Pelanggan::all();
        return view('be.admin.pelanggans', compact('pelanggans'));
    }


    public function destroy($id)
    {
        $user = Pelanggan::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function createPelangganPage()
    {
        return view('be.admin.pelanggancreate');
    }

    public function storePelanggan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggan',
            'katakunci' => 'required|string|min:8|max:15|confirmed',
            'no_telp' => 'required|string|max:15',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email' => $request->email,
            'katakunci' => Hash::make($request->katakunci),
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->intended('/pelanggans')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function editPelangganPage($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('be.admin.pelangganupdate', compact('pelanggan'));
    }

    public function updatePelanggan(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'katakunci' => 'nullable|string|min:8|confirmed',
            'no_telp' => 'required|string|max:15',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->email = $request->email;
        $pelanggan->no_telp = $request->no_telp;

        if ($request->filled('katakunci')) {
            $pelanggan->katakunci = Hash::make($request->katakunci);
        }

        $pelanggan->save();

        return redirect()->route('pelanggans')->with('success', 'Pelanggan berhasil diperbarui');
    }
}
