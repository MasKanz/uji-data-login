<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodeBayar extends Model
{
    protected $table = 'metode_bayar';

    protected $fillable = [
        'metode_pembayaran',
        'tempat_bayar',
        'no_rekening',
        'url_logo',
    ];

    function kredit()
    {
        return $this->hasMany(Kredit::class, 'id_metode_bayar');
    }
}
