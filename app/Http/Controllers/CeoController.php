<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('be.ceo.index', [
            'title' => 'Ceo'
        ]);
    }

    public function dashboard()
    {
        // Jumlah total pengajuan
        $totalPengajuan = \App\Models\PengajuanKredit::count();

        // Pengajuan disetujui vs ditolak
        $pengajuanDisetujui = \App\Models\PengajuanKredit::where('status_pengajuan', 'Diterima')->count();
        $pengajuanDitolak = \App\Models\PengajuanKredit::where('status_pengajuan', 'Dibatalkan Penjual')->count();

        // Angsuran lunas vs belum lunas
        $angsuranLunas = \App\Models\Kredit::where('status_kredit', 'Lunas')->count();
        $angsuranBelumLunas = \App\Models\Kredit::where('status_kredit', 'Dicicil')->count();

        // Total pendapatan dari kredit (angsuran yang diterima)
        $totalPendapatan = \App\Models\Angsuran::where('keterangan', 'Diterima')->sum('total_bayar');

        // Rata-rata margin keuntungan (dari jenis cicilan)
        $avgMargin = \App\Models\JenisCicilan::avg('margin_kredit');

        // Jumlah pengiriman berhasil
        $pengirimanBerhasil = \App\Models\Pengiriman::where('status_kirim', 'Tiba Di Tujuan')->count();

        // Data tren waktu: pengajuan per bulan (12 bulan terakhir)
        $pengajuanPerBulan = \App\Models\PengajuanKredit::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('be.ceo.dashboard', compact(
            'totalPengajuan', 'pengajuanDisetujui', 'pengajuanDitolak',
            'angsuranLunas', 'angsuranBelumLunas', 'totalPendapatan',
            'avgMargin', 'pengirimanBerhasil', 'pengajuanPerBulan'
        ));
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
        //
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
