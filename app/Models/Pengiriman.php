<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
        'id_kredit',
        'no_invoice',
        'tgl_kirim',
        'tgl_tiba',
        'status_kirim',
        'nama_kurir',
        'telpon_kurir',
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
