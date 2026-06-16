<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';
    protected $primaryKey = 'id_quiz';
 
    protected $fillable = [
        'id_akun',
        'id_latihan',
        'nama_quiz',
        'slug',
        'is_active',
    ];
    
    // relasi
    protected $casts = [
        'is_active' => 'boolean',
    ];
 
    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }
 
    public function latihan(): BelongsTo
    {
        return $this->belongsTo(Latihan::class, 'id_latihan', 'id_latihan');
    }
 
    public function quizSoal(): HasMany
    {
        return $this->hasMany(QuizSoal::class, 'id_quiz', 'id_quiz')->orderBy('urutan');
    }
}
