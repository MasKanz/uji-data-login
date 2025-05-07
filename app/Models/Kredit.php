<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
    protected $table = 'kredit';

    protected $fillable = [
        'id_pengajuan_kredit',
        'id_metode_bayar',
        'tgl_mulai_kredit',
        'tgl_selesai_kredit',
        'sisa_kredit',
        'status_kredit',
        'keterangan_status_kredit',
    ];

    public function pengajuanKredit()
    {
        return $this->belongsTo(PengajuanKredit::class, 'id_pengajuan_kredit');
    }

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class, 'id_kredit');
    }

    public function asuransi()
    {
        return $this->hasOne(Asuransi::class, 'id_asuransi');
    }
}
