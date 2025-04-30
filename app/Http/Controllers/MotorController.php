<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\JenisMotor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    // Menampilkan semua data motor
    public function index()
    {
        $motors = Motor::with('jenisMotor')->get();
        return view('be.motor.index', compact('motors'));
    }

    // Menampilkan form tambah motor
    public function createMotorPage()
    {
        $jenisList = JenisMotor::all();
        return view('be.motor.create', compact('jenisList'));
    }

    // Menyimpan data motor baru
    public function storeMotor(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required|unique:motor,nama_motor',
            'idjenis' => 'required|exists:jenis_motor,id',
            'harga_jual' => 'required|integer',
            'deskripsi_motor' => 'required',
            'warna' => 'required',
            'kapasitas_mesin' => 'required',
            'tahun_produksi' => 'required',
            'foto1' => 'required|image',
            'foto2' => 'nullable|image',
            'foto3' => 'nullable|image',
            'stok' => 'required|integer',
        ]);

        $motor = new Motor($request->except(['foto1', 'foto2', 'foto3']));

        // Handle upload foto
        $motor->foto1 = $request->file('foto1')->store('foto_motor', 'public');
        if ($request->hasFile('foto2')) {
            $motor->foto2 = $request->file('foto2')->store('foto_motor', 'public');
        }
        if ($request->hasFile('foto3')) {
            $motor->foto3 = $request->file('foto3')->store('foto_motor', 'public');
        }

        $motor->save();

        return redirect()->route('be.motor.index')->with('success', 'Data motor berhasil ditambahkan.');
    }

    // Menampilkan detail motor
    public function showMotorDetail($id)
    {
        $motor = Motor::with('jenisMotor')->findOrFail($id);
        return view('be.motor.show', compact('motor'));
    }

    // Menampilkan form edit motor
    public function edit($id)
    {
        $motor = Motor::findOrFail($id);
        $jenisList = JenisMotor::all();
        return view('be.motor.edit', compact('motor', 'jenisList'));
    }

    // Update data motor
    public function update(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);

        $request->validate([
            'nama_motor' => 'required|unique:motor,nama_motor,' . $motor->id,
            'idjenis' => 'required|exists:jenis_motor,id',
            'harga_jual' => 'required|integer',
            'deskripsi_motor' => 'required',
            'warna' => 'required',
            'kapasitas_mesin' => 'required',
            'tahun_produksi' => 'required',
            'foto1' => 'nullable|image',
            'foto2' => 'nullable|image',
            'foto3' => 'nullable|image',
            'stok' => 'required|integer',
        ]);

        $motor->fill($request->except(['foto1', 'foto2', 'foto3']));

        if ($request->hasFile('foto1')) {
            $motor->foto1 = $request->file('foto1')->store('foto_motor', 'public');
        }
        if ($request->hasFile('foto2')) {
            $motor->foto2 = $request->file('foto2')->store('foto_motor', 'public');
        }
        if ($request->hasFile('foto3')) {
            $motor->foto3 = $request->file('foto3')->store('foto_motor', 'public');
        }

        $motor->save();

        return redirect()->route('be.motor.index')->with('success', 'Data motor berhasil diperbarui.');
    }

    // Hapus motor
    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->delete();
        return redirect()->route('be.motor.index')->with('success', 'Data motor berhasil dihapus.');
    }
}
