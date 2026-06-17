<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalItemQte extends Model
{
    use HasFactory;

    protected $table = 'soal_item_qte';

    protected $primaryKey = 'id_item_qte';

    protected $fillable = ['id_soal', 'isi_item', 'is_correct'];
}
