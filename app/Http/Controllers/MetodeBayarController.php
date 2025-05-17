<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodeBayar;

class MetodeBayarController extends Controller
{
    public function index()
    {
        $metodeList = MetodeBayar::paginate(10);
        return view('be.metodebayar.index', compact('metodeList'));
    }

    public function create()
    {
        return view('be.metodebayar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|max:30',
            'tempat_bayar' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:25',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $logoPath = $request->file('url_logo') ? $request->file('url_logo')->store('metodebayar', 'public') : null;

        MetodeBayar::create([
            'metode_pembayaran' => $request->metode_pembayaran,
            'tempat_bayar' => $request->tempat_bayar,
            'no_rekening' => $request->no_rekening,
            'url_logo' => $logoPath,
        ]);

        return redirect()->route('metode-bayar')->with('success', 'Metode bayar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $metode = MetodeBayar::findOrFail($id);
        return view('be.metodebayar.edit', compact('metode'));
    }

    public function update(Request $request, $id)
    {
        $metode = MetodeBayar::findOrFail($id);

        $request->validate([
            'metode_pembayaran' => 'required|string|max:30',
            'tempat_bayar' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:25',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $logoPath = $metode->url_logo;
        if ($request->hasFile('url_logo')) {
            $logoPath = $request->file('url_logo')->store('metodebayar', 'public');
        }

        $metode->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'tempat_bayar' => $request->tempat_bayar,
            'no_rekening' => $request->no_rekening,
            'url_logo' => $logoPath,
        ]);

        return redirect()->route('metode-bayar')->with('success', 'Metode bayar berhasil diupdate.');
    }

    public function destroy($id)
    {
        $metode = MetodeBayar::findOrFail($id);
        $metode->delete();
        return redirect()->route('metode-bayar')->with('success', 'Metode bayar berhasil dihapus.');
    }
}
