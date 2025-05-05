<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $table = 'motor';

    protected $fillable = [
        'nama_motor',
        'idjenis',
        'harga_jual',
        'deskripsi_motor',
        'warna',
        'kapasitas_mesin',
        'tahun_produksi',
        'foto1',
        'foto2',
        'foto3',
        'stok',
    ];

    /**
     * Relasi ke tabel jenis_motor
     */
    public function jenisMotor()
    {
        return $this->belongsTo(JenisMotor::class, 'idjenis');
    }
}
