<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisCicilan extends Model
{
    protected $table = 'jenis_cicilan';

    protected $fillable = [
        'lama_cicilan',      // jumlah bulan, misal: 12, 24, 36
        'margin_kredit',     // bunga/markup kredit, misal: 0.12 (12%)
    ];

    // Relasi ke pengajuan kredit
    public function pengajuanKredit()
    {
        return $this->hasMany(PengajuanKredit::class, 'id_jenis_cicilan');
    }
}
