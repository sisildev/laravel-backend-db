<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto_profile',
        'role',
        'google_id',
        'photo_url',
        'phone',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function riwayat()
    {
        return $this->hasMany(Riwayat::class, 'id_user', 'id');
    }
}