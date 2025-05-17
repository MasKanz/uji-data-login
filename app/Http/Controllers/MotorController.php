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
        $motors = Motor::with('jenisMotor')->paginate(10);
        return view('be.motor.index', compact('motors'));
    }

    // Menampilkan form tambah motor
    public function createMotorPage()
    {
        $jenisList = JenisMotor::paginate(10);
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
            'foto1' => 'required|image|mimes:jpeg,png,jpg,webp',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'stok' => 'required|integer',
        ]);

        $motor = new Motor($request->except(['foto1', 'foto2', 'foto3']));

        // Handle upload foto

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

        return redirect()->route('motors')->with('success', 'Data motor berhasil ditambahkan.');
    }

    // Menampilkan detail motor
    public function showMotorDetail($id)
    {
        $motor = Motor::with('jenisMotor')->findOrFail($id);
        return view('be.motor.show', compact('motor'));
    }

    // Menampilkan form edit motor
    public function editMotorPage($id)
    {
        $motor = Motor::findOrFail($id);
        $jenisList = JenisMotor::paginate(10);
        return view('be.motor.edit', compact('motor', 'jenisList'));
    }

    // Update data motor
    public function updateMotor(Request $request, $id)
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
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,webp',
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

        return redirect()->route('motors')->with('success', 'Data motor berhasil diperbarui.');
    }

    // Hapus motor
    public function destroyMotor($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->delete();
        return redirect()->route('motors')->with('success', 'Data motor berhasil dihapus.');
    }

    public function indexJenisMotor() {
        $jenisList = JenisMotor::paginate(10);
        return view('be.motor.indexjenis', compact('jenisList'));
    }

    public function createJenisMotorPage()
    {
        return view('be.motor.createjenis');
    }


    public function storeJenisMotor(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'jenis' => 'required|in:Bebek,Skuter,Dual Sport,Naked Sport,Sport Bike,Retro,Cruiser,Sport Touring,Dirt Bike,Motocross,Scrambler,ATV,Motor Adventure,Lainnya',
            'deskripsi_jenis' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        $jenisList = new JenisMotor($request->except(['foto1', 'foto2', 'foto3']));

        // Handle upload foto

        if ($request->hasFile('image_url')) {
            $jenisList->image_url = $request->file('image_url')->store('foto_jenis_motor', 'public');
        }

        $jenisList->save();

        return redirect()->route('jenis-motors')->with('success', 'Jenis motor berhasil ditambahkan.');
    }

    public function editJenisMotorPage($id)
    {
        $jenis_motor = JenisMotor::findOrFail($id);
        return view('be.motor.editjenis', compact('jenis_motor'));
    }

    public function updateJenisMotor(Request $request, $id)
    {
        $request->validate([
            'merk' => 'required',
            'jenis' => 'required|in:Bebek,Skuter,Dual Sport,Naked Sport,Sport Bike,Retro,Cruiser,Sport Touring,Dirt Bike,Motocross,Scrambler,ATV,Motor Adventure,Lainnya',
            'deskripsi_jenis' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg,webp',
        ]);

        $jenisList = JenisMotor::findOrFail($id);
        $jenisList->merk = $request->merk;
        $jenisList->jenis = $request->jenis;
        $jenisList->deskripsi_jenis = $request->deskripsi_jenis;

        if ($request->hasFile('image_url')) {
            $jenisList->image_url = $request->file('image_url')->store('foto_jenis_motor', 'public');
        }

        $jenisList->save();

        return redirect()->route('jenis-motors')->with('success', 'Jenis Motor berhasil diperbarui');
    }

    public function destroyJenisMotor($id)
    {
        $jenis_motor = JenisMotor::findOrFail($id);
        $jenis_motor->delete();
        return redirect()->route('jenis-motors')->with('success', 'Jenis motor berhasil dihapus.');
    }
}
