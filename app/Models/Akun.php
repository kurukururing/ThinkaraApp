<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use Notifiable;

    protected $table = 'akun';
    protected $primaryKey = 'id_akun'; 

    // Set ke true jika id_akun bertipe AI (Auto Increment) / Integer
    public $incrementing = true; 
    protected $keyType = 'int'; 

    protected $fillable = [
        'username',
        'email',
        'password',
        'user_role',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    // =========================================================================
    // OVERRIDE METHOD UTK AUTH SESSION (Paling Krusial)
    // =========================================================================

    public function getAuthIdentifierName()
    {
        return 'id_akun';
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getKeyName());
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id_akun', 'id_akun');
    }
}