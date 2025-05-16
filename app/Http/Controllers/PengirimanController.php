<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;


use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengirimanList = \App\Models\Pengiriman::with(['kredit.pengajuanKredit.pelanggan', 'kurir'])->orderByDesc('created_at')->get();
        return view('be.pengiriman.index', compact('pengirimanList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $kreditList = \App\Models\Kredit::whereDoesntHave('pengiriman')->get();
        // $kurirList = \App\Models\User::where('role', 'kurir')->get();
        // return view('be.pengiriman.create', compact('kreditList', 'kurirList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kredit' => 'required|exists:kredit,id',
            'id_kurir' => 'required|exists:users,id',
            'tgl_pengiriman' => 'required|date',
            'status_pengiriman' => 'required|in:Sedang Dikirim,Tiba Di Tujuan',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $buktiFoto = null;
        if ($request->hasFile('bukti_foto')) {
            $buktiFoto = $request->file('bukti_foto')->store('bukti_pengiriman', 'public');
        }

        \App\Models\Pengiriman::create([
            'id_kredit' => $request->id_kredit,
            'id_kurir' => $request->id_kurir,
            'tgl_pengiriman' => $request->tgl_pengiriman,
            'status_pengiriman' => $request->status_pengiriman,
            'bukti_foto' => $buktiFoto,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengiriman = \App\Models\Pengiriman::with(['kredit.pengajuanKredit.pelanggan', 'kurir'])->findOrFail($id);
        return view('be.pengiriman.show', compact('pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengiriman = \App\Models\Pengiriman::findOrFail($id);
        $kurirList = \App\Models\User::where('role', 'kurir')->get();
        return view('be.pengiriman.edit', compact('pengiriman', 'kurirList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengiriman = \App\Models\Pengiriman::findOrFail($id);

        $request->validate([
            'id_kurir' => 'required|exists:users,id',
            'tgl_pengiriman' => 'required|date',
            'status_pengiriman' => 'required|in:Sedang Dikirim,Tiba Di Tujuan',
            'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('bukti_foto')) {
            $pengiriman->bukti_foto = $request->file('bukti_foto')->store('bukti_pengiriman', 'public');
        }

        $pengiriman->id_kurir = $request->id_kurir;
        $pengiriman->tgl_pengiriman = $request->tgl_pengiriman;
        $pengiriman->status_pengiriman = $request->status_pengiriman;
        $pengiriman->keterangan = $request->keterangan;
        $pengiriman->save();

        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengiriman = \App\Models\Pengiriman::findOrFail($id);
        $pengiriman->delete();
        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil dihapus.');
    }
}
