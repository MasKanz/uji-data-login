<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKredit;
use App\Models\Motor;
use App\Models\JenisCicilan;
use App\Models\Asuransi;
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
        $asuransiList = Asuransi::all();
        return view('fe.pengajuan.pengajuan', compact('motors', 'jenisCicilan', 'asuransiList'), [
            'title' => 'Pengajuan'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_motor' => 'required|exists:motor,id',
            'dp' => 'required|numeric|min:0',
            'id_jenis_cicilan' => 'required|exists:jenis_cicilan,id',
            'id_asuransi' => 'required|exists:asuransi,id',
            'url_kk' => 'required|file|mimes:jpeg,png,jpg,pdf,webp',
            'url_ktp' => 'required|file|mimes:jpeg,png,jpg,pdf,webp',
            'url_npwp' => 'required|file|mimes:jpeg,png,jpg,pdf,webp',
            'url_slip_gaji' => 'required|file|mimes:jpeg,png,jpg,pdf,webp',
            'url_foto' => 'required|file|mimes:jpeg,png,jpg,pdf,webp',
        ]);

        $motor = Motor::findOrFail($request->id_motor);
        $cicilan = JenisCicilan::findOrFail($request->id_jenis_cicilan);
        $asuransi = Asuransi::findOrFail($request->id_asuransi);

        $hargaCash = $motor->harga_jual; // Pastikan field harga_jual ada di tabel motor
        $dp = $request->dp; // Uang muka yang dibayarkan
        $tenor = $cicilan->lama_cicilan; // misal: 12 bulan
        $bunga = $cicilan->margin_kredit; // misal: 0.12 (12% per tahun)

        $pokokKredit = $hargaCash - $dp; // Pokok kredit setelah DP
        $totalBunga = $pokokKredit * $bunga * ($tenor); // Total bunga selama tenor
        $totalKredit = $pokokKredit + $totalBunga; // Total kredit yang harus dibayar
        $cicilanPerBulan = $totalKredit / $tenor; // Cicilan per bulan
        $asuransiPerBulan = $motor->harga_jual * $asuransi->margin_asuransi / $tenor; // Asuransi per bulan

        $kkPath =  $request->file('url_kk')->store('dokumen', 'private');
        $ktpPath = $request->file('url_ktp')->store('dokumen', 'private');
        $npwpPath = $request->file('url_npwp')->store('dokumen', 'private');
        $slipGajiPath = $request->file('url_slip_gaji')->store('dokumen', 'private');
        $fotoPath = $request->file('url_foto')->store('dokumen', 'private');

        PengajuanKredit::create([
            'tgl_pengajuan_kredit' => now(),
            'id_pelanggan' => Auth::guard('pelanggan')->id(),
            'id_motor' => $request->id_motor,
            'harga_cash' => $hargaCash,
            'dp' => $dp,
            'id_jenis_cicilan' => $request->id_jenis_cicilan,
            'harga_kredit' => $totalKredit,
            'id_asuransi' => $request->id_asuransi,
            'biaya_asuransi_perbulan' => $asuransiPerBulan,
            'cicilan_perbulan' => $cicilanPerBulan,
            'url_kk' => $kkPath,
            'url_ktp' => $ktpPath,
            'url_npwp' => $npwpPath,
            'url_slip_gaji' => $slipGajiPath,
            'url_foto' => $fotoPath,
            'status_pengajuan' => 'Menunggu Konfirmasi',
            'keterangan_status_pengajuan' => '',
            // tambahkan field lain sesuai kebutuhan
        ]);

        return redirect()->route('pelanggan.profile')->with('success', 'Pengajuan kredit berhasil dikirim!');
    }


    /**
     * Display resources
     */
    public function indexJenisCicilan()
    {
        $jenisCicilan = JenisCicilan::all();
        return view('be.jeniscicilan.index', compact('jenisCicilan'));
    }

    /**
     * Show create page.
     */
    public function createJenisCicilanPage()
    {
        return view('be.jeniscicilan.create');
    }

    /**
     * Store the newly create resource.
     */
    public function storeJenisCicilan(Request $request)
    {
        $request->validate([
            'lama_cicilan' => 'required|integer|min:1',
            'margin_kredit' => 'required|numeric|min:0',
        ]);

        JenisCicilan::create([
            'lama_cicilan' => $request->lama_cicilan,
            'margin_kredit' => $request->margin_kredit,
        ]);

        return redirect()->route('jenis-cicilan')->with('success', 'Jenis cicilan berhasil ditambahkan.');
    }

    /**
     * Show Edit Page
     */
    public function editJenisCicilanPage($id)
    {
        $jenisCicilan = JenisCicilan::findOrFail($id);
        return view('be.jeniscicilan.edit', compact('jenisCicilan'));
    }

    /**
     * Update the specified resource from storage.
     */
    public function updateJenisCicilan(Request $request, $id)
    {
        $request->validate([
            'lama_cicilan' => 'required|integer|min:1',
            'margin_kredit' => 'required|numeric|min:0',
        ]);

        $cicilan = JenisCicilan::findOrFail($id);
        $cicilan->update([
            'lama_cicilan' => $request->lama_cicilan,
            'margin_kredit' => $request->margin_kredit,
        ]);

        return redirect()->route('jenis-cicilan')->with('success', 'Jenis cicilan berhasil diupdate.');
    }

    public function destroyJenisCicilan($id)
    {
        $cicilan = JenisCicilan::findOrFail($id);
        $cicilan->delete();
        return redirect()->route('jenis-cicilan')->with('success', 'Jenis cicilan berhasil dihapus.');
    }
}
