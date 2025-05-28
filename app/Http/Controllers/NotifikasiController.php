<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function read($id)
    {
        $notif = Notifikasi::where('id', $id)
            ->where('id_pelanggan', auth('pelanggan')->id())
            ->firstOrFail();

        $notif->dibaca = true;
        $notif->save();

        return back();
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
        $notif = \App\Models\Notifikasi::where('id', $id)
            ->where('id_pelanggan', auth('pelanggan')->id())
            ->firstOrFail();

        $notif->delete();

        return back();
    }
}
