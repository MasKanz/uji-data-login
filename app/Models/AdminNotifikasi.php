<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotifikasi extends Model
{
    protected $table = 'admin_notifikasi';
    protected $fillable = [
        'id_pengajuan_kredit',
        'id_pelanggan',
        'judul',
        'pesan',
        'tipe',
        'role',
        'dibaca'
    ];

    // Relasi ke PengajuanKredit
    public function pengajuan()
    {
        return $this->belongsTo(PengajuanKredit::class, 'id_pengajuan_kredit');
    }

    // Relasi ke Kredit (untuk notifikasi pembayaran)
    public function kredit()
    {
        return $this->belongsTo(Kredit::class, 'id_pengajuan_kredit');
    }

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
