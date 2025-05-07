<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
        'id_kredit',
        'id_kurir',
        'tgl_pengiriman',
        'status_pengiriman',
        'bukti_foto',
        'keterangan',
    ];

    // Relasi ke kredit
    public function kredit()
    {
        return $this->belongsTo(Kredit::class, 'id_kredit');
    }

    // Relasi ke user (kurir)
    public function kurir()
    {
        return $this->belongsTo(User::class, 'id_kurir');
    }

}
