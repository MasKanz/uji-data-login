<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kredit;


class KreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kreditList = Kredit::with(['pengajuanKredit.pelanggan', 'pengajuanKredit.motor', 'pengajuanKredit.jenisCicilan', 'pengajuanKredit.asuransi', 'angsuran'])->latest()->get();
        return view('be.kredit.index', compact('kreditList'));
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
    public function show($id)
    {
        $kredit = Kredit::with(['pengajuanKredit.pelanggan', 'pengajuanKredit.motor', 'pengajuanKredit.jenisCicilan', 'pengajuanKredit.asuransi', 'angsuran'])->findOrFail($id);
        return view('be.kredit.show', compact('kredit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kredit = Kredit::with(['pengajuanKredit.pelanggan', 'pengajuanKredit.motor'])->findOrFail($id);
        return view('be.kredit.edit', compact('kredit'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $kredit = Kredit::findOrFail($id);
        $request->validate([
            'status_kredit' => 'required|in:Dicicil,Macet,Lunas',
            'keterangan_status_kredit' => 'nullable|string|max:255',
        ]);
        $kredit->update([
            'status_kredit' => $request->status_kredit,
            'keterangan_status_kredit' => $request->keterangan_status_kredit,
        ]);
        return redirect()->route('kredit.show', $kredit->id)->with('success', 'Status kredit berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kredit = Kredit::findOrFail($id);
        $kredit->delete();
        return redirect()->route('kredit')->with('success', 'Data kredit berhasil dihapus.');
    }

    public function showPelangganDetails($id)
    {
        $kredit = Kredit::with(['pengajuanKredit.pelanggan', 'pengajuanKredit.motor', 'pengajuanKredit.jenisCicilan', 'pengajuanKredit.asuransi', 'angsuran'])->findOrFail($id);
        return view('fe.kredit.details', compact('kredit'), [
            'title' => 'Kredit Details',
        ]);
    }
}
