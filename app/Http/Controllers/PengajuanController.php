<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKredit;
use App\Models\Motor;
use App\Models\JenisCicilan;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motors = Motor::all();
        $jenisCicilan = JenisCicilan::all();
        return view('fe.pengajuan.pengajuan', compact('motors', 'jenisCicilan'), [
            'title' => 'Pengajuan'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_motor' => 'required|exists:motor,id',
            'dp' => 'required|numeric|min:0',
            'id_jenis_cicilan' => 'required|exists:jenis_cicilan,id',
            'url_ktp' => 'required|file|mimes:jpeg,png,jpg,pdf',
            // tambahkan validasi dokumen lain
        ]);

        $ktpPath = $request->file('url_ktp')->store('dokumen', 'public');

        PengajuanKredit::create([
            'tgl_pengajuan_kredit' => now(),
            'id_pelanggan' => Auth::guard('pelanggan')->id(),
            'id_motor' => $request->id_motor,
            'dp' => $request->dp,
            'id_jenis_cicilan' => $request->id_jenis_cicilan,
            'url_ktp' => $ktpPath,
            'status_pengajuan' => 'Menunggu Konfirmasi',
            'keterangan_status_pengajuan' => '',
            // tambahkan field lain sesuai kebutuhan
        ]);

        return redirect()->route('profilepelanggan')->with('success', 'Pengajuan kredit berhasil dikirim!');
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
