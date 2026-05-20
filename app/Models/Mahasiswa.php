<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Menentukan nama tabel karena tidak menggunakan aturan jamak (plural) Laravel
    protected $table = 'mahasiswa';

    // Menentukan primary key custom
    protected $primaryKey = 'id_mahasiswa';

    // Kolom yang diizinkan untuk pengisian massal (Mass Assignment)
    protected $fillable = [
        'id_akun',
        'npm',
        'nama_mahasiswa',
        'jenis_kelamin',
        'jenjang',
        'tanggal_lahir',
        'instansi',
    ];

    // Mengatur tipe data kolom tanggal_lahir agar otomatis dikonversi menjadi objek Carbon/Date
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi ke model Akun (One to One Inverse / BelongsTo)
     * Menghubungkan mahasiswa kembali ke akun login-nya.
     */
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }
}