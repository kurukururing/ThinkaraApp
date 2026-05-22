<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit karena bukan bentuk jamak bahasa Inggris (soals)
    protected $table = 'soal';

    // Menentukan primary key custom
    protected $primaryKey = 'id_soal';

    // Kolom yang diizinkan untuk pengisian massal (Mass Assignment)
    protected $fillable = [
        'id_latihan',
        'topik',
        'isi_soal',
    ];

    /**
     * Relasi One-to-Many ke SoalItemBuilder
     */
    public function builderItems()
    {
        return $this->hasMany(SoalItemBuilder::class, 'id_soal', 'id_soal');
    }

    /**
     * Relasi One-to-Many ke SoalItemFallacy
     */
    public function fallacyItems()
    {
        return $this->hasMany(SoalItemFallacy::class, 'id_soal', 'id_soal');
    }

    /**
     * Relasi One-to-Many ke SoalItemQte (Gamified QTE)
     */
    public function qteItems()
    {
        return $this->hasMany(SoalItemQte::class, 'id_soal', 'id_soal');
    }
}
