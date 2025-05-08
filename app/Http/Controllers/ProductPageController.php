<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\JenisMotor;

class ProductPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mulai dengan Query Builder, bukan Collection
        $tipe = Motor::with('jenisMotor');

        // Filter jika ada request jenis
        if ($request->filled('jenis')) {
            $motors = $tipe->whereHas('jenisMotor', function($q) use ($request) {
                $q->where('jenis', $request->jenis);
            });
        }

        // Ambil data setelah filter selesai
        $motors = $tipe->get();

        $jenisList = JenisMotor::select('jenis')->distinct()->get();

        return view('fe.product.product', compact('motors', 'jenisList'), [
            'title' => 'Shop',
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $motor = Motor::with('jenisMotor')->findOrFail($id);
        return view('fe.product.details', compact('motor'), [
            'title' => 'Shop'
        ]);
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
