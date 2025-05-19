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
        $pengirimanList = \App\Models\Pengiriman::with(['kredit.pengajuanKredit.pelanggan', 'kurir'])->orderByDesc('created_at')->paginate(10);
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
        // $request->validate([
        //     'id_kredit' => 'required|exists:kredit,id',
        //     'no_invoice' => 'required|unique:pengiriman,no_invoice',
        //     'tgl_kirim' => 'required|date',
        //     'status_kirim' => 'required|in:Sedang Dikirim,Tiba Di Tujuan',
        //     'nama_kurir' => 'required|string|max:255',
        //     'telpon_kurir' => 'required|string|max:20',
        //     'bukti_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        //     'keterangan' => 'nullable|string',
        // ]);

        // $buktiFoto = null;
        // if ($request->hasFile('bukti_foto')) {
        //     $buktiFoto = $request->file('bukti_foto')->store('bukti_pengiriman', 'public');
        // }

        // \App\Models\Pengiriman::create([
        //     'id_kredit' => $request->id_kredit,
        //     'no_invoice' => $request->no_invoice,
        //     'tgl_kirim' => $request->tgl_kirim,
        //     'tgl_tiba' => null,
        //     'status_kirim' => $request->status_kirim,
        //     'nama_kurir' => $request->nama_kurir,
        //     'telpon_kurir' => $request->telpon_kurir,
        //     'bukti_foto' => $buktiFoto,
        //     'keterangan' => $request->keterangan,
        // ]);

        // return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil ditambahkan.');
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
        return view('be.pengiriman.edit', compact('pengiriman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengiriman = \App\Models\Pengiriman::findOrFail($id);

        $request->validate([
            'no_invoice'    => 'required|string|max:255|unique:pengiriman,no_invoice,' . $pengiriman->id,
            'tgl_kirim'     => 'required|date',
            'tgl_tiba'      => 'nullable|date|after_or_equal:tgl_kirim',
            'status_kirim'  => 'required|in:Sedang Dikirim,Tiba Di Tujuan',
            'nama_kurir'    => 'required|string|max:255',
            'telpon_kurir'  => 'required|string|max:20',
            'bukti_foto'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan'    => 'nullable|string',
        ]);

        if ($request->hasFile('bukti_foto')) {
            $pengiriman->bukti_foto = $request->file('bukti_foto')->store('bukti_pengiriman', 'public');
        }

        $pengiriman->no_invoice    = $request->no_invoice;
        $pengiriman->tgl_kirim     = $request->tgl_kirim;
        $pengiriman->tgl_tiba      = $request->tgl_tiba;
        $pengiriman->status_kirim  = $request->status_kirim;
        $pengiriman->nama_kurir    = $request->nama_kurir;
        $pengiriman->telpon_kurir  = $request->telpon_kurir;
        $pengiriman->keterangan    = $request->keterangan;
        $pengiriman->save();

        return redirect()->route('pengiriman')->with('success', 'Pengiriman berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengiriman = \App\Models\Pengiriman::findOrFail($id);
        $pengiriman->delete();
        return redirect()->route('pengiriman')->with('success', 'Pengiriman berhasil dihapus.');
    }
}
