<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    protected $table = 'latihan';
    protected $primaryKey = 'id_latihan';

    protected $fillable = [
        'nama_latihan',
    ];

    // Relasi One-to-Many ke Soal
    public function soal()
    {
        return $this->hasMany(Soal::class, 'id_latihan', 'id_latihan');
    }
}
