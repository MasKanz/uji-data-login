<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanKredit extends Model
{

    protected $table = 'pengajuan_kredit';

    protected $fillable = [
        'tgl_pengajuan_kredit',
        'id_pelanggan',
        'id_motor',
        'harga_cash',
        'dp',
        'id_jenis_cicilan',
        'harga_kredit',
        'id_asuransi',
        'biaya_asuransi_perbulan',
        'cicilan_perbulan',
        'id_metode_bayar',
        'url_kk',
        'url_ktp',
        'url_npwp',
        'url_slip_gaji',
        'url_foto',
        'status_pengajuan',
        'keterangan_status_pengajuan',
    ];

    // Relasi ke pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    // Relasi ke motor
    public function motor()
    {
        return $this->belongsTo(Motor::class, 'id_motor');
    }

    // Relasi ke jenis cicilan
    public function jenisCicilan()
    {
        return $this->belongsTo(JenisCicilan::class, 'id_jenis_cicilan');
    }

    // Relasi ke asuransi
    public function asuransi()
    {
        return $this->belongsTo(Asuransi::class, 'id_asuransi');
    }

    // Relasi ke kredit
    public function kredit()
    {
        return $this->hasOne(Kredit::class, 'id_pengajuan_kredit');
    }
}
