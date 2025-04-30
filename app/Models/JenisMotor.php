<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMotor extends Model
{
    use HasFactory;

    protected $table = 'jenis_motor';

    protected $fillable = [
        'merk',
        'jenis',
        'deskripsi_jenis',
        'image_url',
    ];

    /**
     * Relasi ke model Motor (satu jenis bisa punya banyak motor)
     */
    public function motor()
    {
        return $this->hasMany(Motor::class, 'idjenis');
    }
}
