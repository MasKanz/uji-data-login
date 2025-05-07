<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $table = 'angsuran';

    protected $fillable = [
        'id_kredit',
        'tgl_bayar',
        'angsuran_ke',
        'total_bayar',
        'keterangan',
    ];

    public function kredit()
    {
        return $this->belongsTo(Kredit::class, 'id_kredit');
    }
}
