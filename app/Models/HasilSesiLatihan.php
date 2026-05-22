<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilSesiLatihan extends Model
{
    protected $table = 'hasil_sesi_latihan';

    protected $primaryKey = 'id_hasil_latihan';

    protected $fillable = [
        'id_akun',
        'id_latihan',
        'xp',
        'skor',
        'waktu_main',
        'durasi',
    ];
}
