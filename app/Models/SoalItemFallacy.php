<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalItemFallacy extends Model
{
    use HasFactory;

    protected $table = 'soal_item_fallacy';

    protected $fillable = [
        'id_soal',
        'teks_opsi',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /**
     * Relasi Inverse One-to-Many kembali ke Soal
     */
    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal', 'id_soal');
    }
}