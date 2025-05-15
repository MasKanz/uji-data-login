<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kredit;
use App\Models\Angsuran;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil kredit milik pelanggan yang sedang login
        $kredits = Kredit::whereHas('pengajuanKredit', function($q) {
            $q->where('id_pelanggan', auth('pelanggan')->id());
        })->get();

        return view('fe.pembayaran.pembayaran', [
            'title' => 'Pembayaran',
            'kredits' => $kredits,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kredit' => 'required|exists:kredit,id',
            'total_bayar' => 'required|numeric|min:1',
            'bukti_bayar' => 'required|file|mimes:jpeg,png,jpg,pdf,webp|max:2048',
        ]);

        $kredit = Kredit::findOrFail($request->id_kredit);

        // Simpan bukti bayar
        $buktiPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        // Buat angsuran baru
        Angsuran::create([
            'id_kredit' => $kredit->id,
            'tgl_bayar' => now(),
            'angsuran_ke' => ($kredit->angsuran()->count() + 1),
            'total_bayar' => $request->total_bayar,
            'bukti_bayar' => $buktiPath,
            'keterangan' => 'Menunggu Verifikasi',
        ]);

        // Update sisa kredit
        $kredit->sisa_kredit -= $request->total_bayar;
        if ($kredit->sisa_kredit <= 0) {
            $kredit->sisa_kredit = 0;
            $kredit->status_kredit = 'Lunas';
            $kredit->keterangan_status_kredit = 'Kredit telah lunas';
        }
        $kredit->save();

        return redirect()->route('kredit.pelanggan')->with('success', 'Pembayaran berhasil dikirim, menunggu verifikasi.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
