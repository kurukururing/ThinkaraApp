<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSoal extends Model
{
    protected $table = 'quiz_soal';
    protected $primaryKey = 'id_quiz_soal';
 
    protected $fillable = [
        'id_quiz',
        'id_soal',
        'urutan',
    ];

    // Relasi ke Quiz dan Soal
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'id_quiz', 'id_quiz');
    }
 
    public function soal(): BelongsTo
    {
        return $this->belongsTo(Soal::class, 'id_soal', 'id_soal');
    }
}
