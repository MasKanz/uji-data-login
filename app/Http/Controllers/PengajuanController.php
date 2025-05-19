<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKredit;
use App\Models\Motor;
use App\Models\JenisCicilan;
use App\Models\Asuransi;
use Illuminate\Support\Facades\Auth;
use App\Models\Kredit;
use App\Models\Pengiriman;

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
            'title' => 'Pengajuan',
            'motors' => $motors,
            'jenisCicilan' => $jenisCicilan,
            'asuransiList' => $asuransiList,
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

        if ($motor->stok <= 0) {
            return back()->withErrors(['stok' => 'Stok motor habis, pengajuan kredit tidak dapat diproses.'])->withInput();
        }
        $cicilan = JenisCicilan::findOrFail($request->id_jenis_cicilan);
        $asuransi = Asuransi::findOrFail($request->id_asuransi);

        $hargaCash = $motor->harga_jual; // Pastikan field harga_jual ada di tabel motor
        $tenor = $cicilan->lama_cicilan; // misal: 12 bulan

        if ($tenor <= 12) {
            $persentaseKenaikan = 0.05; // 5%
        } elseif ($tenor > 12 && $tenor <= 24) {
            $persentaseKenaikan = 0.10; // 10%
        } elseif ($tenor > 24 && $tenor <= 36) {
            $persentaseKenaikan = 0.15; // 15%
        }

        $hargaMotorKredit = $hargaCash + ($hargaCash * $persentaseKenaikan);

        $dp = $request->dp; // Uang muka yang dibayarkan
        $bunga = $cicilan->margin_kredit; // misal: 0.12 (12% per tahun)

        $pokokKredit = $hargaMotorKredit - $dp; // Pokok kredit setelah DP
        $totalBunga = $pokokKredit * $bunga * ($tenor / 12); // Total bunga selama tenor
        $totalKredit = $pokokKredit + $totalBunga; // Total kredit yang harus dibayar
        $cicilanPerBulan = $totalKredit / $tenor; // Cicilan per bulan
        $asuransiPerBulan = $motor->harga_jual * $asuransi->margin_asuransi / $tenor; // Asuransi per bulan

        $kkPath =  $request->file('url_kk')->store('dokumen', 'public');
        $ktpPath = $request->file('url_ktp')->store('dokumen', 'public');
        $npwpPath = $request->file('url_npwp')->store('dokumen', 'public');
        $slipGajiPath = $request->file('url_slip_gaji')->store('dokumen', 'public');
        $fotoPath = $request->file('url_foto')->store('dokumen', 'public');

        PengajuanKredit::create([
            'tgl_pengajuan_kredit' => now(),
            'id_pelanggan' => Auth::guard('pelanggan')->id(),
            'id_motor' => $request->id_motor,
            'harga_cash' => $hargaMotorKredit,
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

        return redirect()->route('pengajuan.pelanggan')->with('success', 'Pengajuan kredit berhasil dikirim!');
    }


    /**
     * Display resources
     */
    public function indexJenisCicilan()
    {
        $jenisCicilan = JenisCicilan::paginate(10);
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

    public function indexPengajuanKredit()
    {
        $pengajuanList = \App\Models\PengajuanKredit::with(['pelanggan', 'motor', 'jenisCicilan', 'asuransi'])->latest()->paginate(10);
        return view('be.pengajuan.index', compact('pengajuanList'));
    }

    public function showPengajuanDetail($id)
    {
        $pengajuan = \App\Models\PengajuanKredit::with(['pelanggan', 'motor', 'jenisCicilan', 'asuransi'])->findOrFail($id);
        return view('be.pengajuan.detail', compact('pengajuan'));
    }

    public function prosesPengajuan($id)
    {
        $pengajuan = \App\Models\PengajuanKredit::findOrFail($id);
        if ($pengajuan->status_pengajuan == 'Menunggu Konfirmasi') {
            $pengajuan->status_pengajuan = 'Diproses';
            $pengajuan->keterangan_status_pengajuan = 'Pengajuan sedang diproses';
            $pengajuan->save();
            return back()->with('success', 'Pengajuan berhasil diproses.');
        }
        return back()->with('error', 'Pengajuan tidak valid untuk diproses.');
    }

    public function konfirmasiPengajuan($id)
    {
        $pengajuan = \App\Models\PengajuanKredit::with(['jenisCicilan', 'asuransi'])->findOrFail($id);

        // Update status pengajuan
        $pengajuan->status_pengajuan = 'Diterima';
        $pengajuan->keterangan_status_pengajuan = 'Pengajuan disetujui';
        $pengajuan->save();

        $pengajuan = PengajuanKredit::findOrFail($id);
        $motor = $pengajuan->motor;
        if ($motor->stok > 0) {
            $motor->stok -= 1;
            $motor->save();
        }

        // Buat data kredit
        Kredit::create([
            'id_pengajuan_kredit' => $pengajuan->id,
            'id_metode_bayar' => 1,
            'tgl_mulai_kredit' => now(),
            'tgl_selesai_kredit' => now()->addMonths($pengajuan->jenisCicilan->lama_cicilan),
            'sisa_kredit' => $pengajuan->harga_kredit + ($pengajuan->biaya_asuransi_perbulan * $pengajuan->jenisCicilan->lama_cicilan),
            'status_kredit' => 'Dicicil',
            'keterangan_status_kredit' => 'Kredit aktif',
        ]);

        // ...proses konfirmasi pengajuan...

        // Buat data kredit jika perlu
        $kredit = \App\Models\Kredit::where('id_pengajuan_kredit', $pengajuan->id)->first();

        // Buat data pengiriman otomatis
        Pengiriman::create([
            'id_kredit'     => $kredit->id,
            'no_invoice'    => 'INV-' . date('YmdHis') . '-' . $kredit->id,
            'tgl_kirim'     => now(),
            'tgl_tiba'      => null, // jika nullable
            'status_kirim'  => 'Sedang Dikirim',
            'nama_kurir'    => '-', // atau isi nama kurir jika sudah ada
            'telpon_kurir'  => '-', // atau isi telpon kurir jika sudah ada
            'bukti_foto'    => null,
            'keterangan'    => 'Pengiriman otomatis setelah konfirmasi kredit',
        ]);

        return redirect()->route('pengajuan-kredit')->with('success', 'Pengajuan berhasil dikonfirmasi & data kredit dibuat.');
    }

    public function batalPengajuan(Request $request, $id)
    {
        $request->validate([
            'alasan_batal' => 'required|string|max:255',
        ]);

        $pengajuan = \App\Models\PengajuanKredit::findOrFail($id);

        // Update status pengajuan menjadi Dibatalkan Penjual dan simpan alasan
        $pengajuan->status_pengajuan = 'Dibatalkan Penjual';
        $pengajuan->keterangan_status_pengajuan = $request->alasan_batal;
        $pengajuan->save();

        // Kirim notifikasi ke pelanggan (opsional: bisa pakai event/email/flash session)
        // Contoh: flash session untuk pelanggan
        session()->flash('notif_pengajuan_batal', [
            'pesan' => 'Pengajuan Anda dibatalkan oleh admin/marketing.',
            'alasan' => $request->alasan_batal
        ]);

        return redirect()->route('pengajuan-kredit')->with('success', 'Pengajuan berhasil dibatalkan.');

    }


    public function listPengajuanPelanggan()
    {
        $pengajuans = \App\Models\PengajuanKredit::with(['motor', 'jenisCicilan', 'asuransi'])
            ->where('id_pelanggan', auth('pelanggan')->id())
            ->orderByDesc('created_at')
            ->paginate(10);


        return view('fe.pengajuan.list', [
            'title' => 'Pengajuan Saya',
            'pengajuans' => $pengajuans,
        ]);
    }

    public function listKreditPelanggan()
    {
        $kredits = \App\Models\Kredit::with(['pengajuanKredit.motor', 'pengajuanKredit.jenisCicilan'])
            ->whereHas('pengajuanKredit', function($q) {
                $q->where('id_pelanggan', auth('pelanggan')->id());
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('fe.kredit.list', [
            'title' => 'Kredit Berjalan',
            'kredits' => $kredits,
        ]);
    }

    public function batalPengajuanPelanggan($id)
    {
        $pengajuan = \App\Models\PengajuanKredit::where('id', $id)
            ->where('id_pelanggan', auth('pelanggan')->id())
            ->where('status_pengajuan', 'Menunggu Konfirmasi')
            ->firstOrFail();

        $pengajuan->status_pengajuan = 'Dibatalkan Pembeli';
        $pengajuan->keterangan_status_pengajuan = 'Dibatalkan oleh pelanggan';
        $pengajuan->save();

        return redirect()->route('pengajuan.pelanggan')->with('success', 'Pengajuan berhasil dibatalkan.');
    }
    public function showPengajuanDetailPelanggan($id)
    {
        $pengajuan = \App\Models\PengajuanKredit::with(['pelanggan', 'motor', 'jenisCicilan', 'asuransi'])->findOrFail($id);
        return view('fe.pengajuan.details', compact('pengajuan'), [
            'title' => 'Detail Pengajuan',
        ]);
    }

    public function notifDitolakDibaca($id)
    {
        $pengajuan = \App\Models\PengajuanKredit::where('id', $id)
            ->where('id_pelanggan', auth('pelanggan')->id())
            ->firstOrFail();

        $pengajuan->notif_ditolak_dibaca = true;
        $pengajuan->save();

        return response()->noContent();
    }

}
