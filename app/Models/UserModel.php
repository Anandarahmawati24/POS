<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable; // implementasi class authenticatable
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;
    
    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }  

    public function getJWTCustomClaims()
    {
        
        return[];
    }
   protected $table = 'm_user'; // mendefinisikan nama tabel yang digunakan oleh model ini
   protected $primaryKey = 'user_id'; // Mendefinisikan primary key dari tabel yang digunakan

}