<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable; // implementasi class authenticatable
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;
    
    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id',
        'image'
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

    public function level()
    {
        return $this->belongsTo(
            LevelModel::class,
            'level_id',
            'level_id'
        );
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/posts/' . $image),
        );
    }

}