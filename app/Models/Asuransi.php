<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
    protected $table = 'asuransi';

    protected $fillable = [
        'nama_perusahaan_asuransi',
        'nama_asuransi',
        'margin_asuransi',
        'no_rekening',
        'url_logo',
    ];

    public function pengajuanKredit()
    {
        return $this->hasMany(PengajuanKredit::class, 'id_asuransi');
    }
}
