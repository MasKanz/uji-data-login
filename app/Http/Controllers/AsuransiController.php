<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asuransi;

class AsuransiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asuransiList = Asuransi::all();
        return view('be.asuransi.index', compact('asuransiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('be.asuransi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan_asuransi' => 'required|string|max:255',
            'nama_asuransi' => 'required|string|max:255',
            'margin_asuransi' => 'required|numeric|min:0',
            'no_rekening' => 'required|string|max:100',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $logoPath = $request->file('url_logo') ? $request->file('url_logo')->store('asuransi', 'public') : null;

        Asuransi::create([
            'nama_perusahaan_asuransi' => $request->nama_perusahaan_asuransi,
            'nama_asuransi' => $request->nama_asuransi,
            'margin_asuransi' => $request->margin_asuransi,
            'no_rekening' => $request->no_rekening,
            'url_logo' => $logoPath,
        ]);

        return redirect()->route('asuransi')->with('success', 'Asuransi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $asuransi = Asuransi::findOrFail($id);
        return view('be.asuransi.edit', compact('asuransi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $asuransi = Asuransi::findOrFail($id);

        $request->validate([
            'nama_perusahaan_asuransi' => 'required|string|max:255',
            'nama_asuransi' => 'required|string|max:255',
            'margin_asuransi' => 'required|numeric|min:0',
            'no_rekening' => 'required|string|max:100',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $logoPath = $asuransi->url_logo;
        if ($request->hasFile('url_logo')) {
            $logoPath = $request->file('url_logo')->store('asuransi', 'public');
        }

        $asuransi->update([
            'nama_perusahaan_asuransi' => $request->nama_perusahaan_asuransi,
            'nama_asuransi' => $request->nama_asuransi,
            'margin_asuransi' => $request->margin_asuransi,
            'no_rekening' => $request->no_rekening,
            'url_logo' => $logoPath,
        ]);

        return redirect()->route('asuransi')->with('success', 'Asuransi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asuransi = Asuransi::findOrFail($id);
        $asuransi->delete();
        return redirect()->route('asuransi')->with('success', 'Asuransi berhasil dihapus.');
    }
}
