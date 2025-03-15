<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Profil;


class User extends Authenticatable
{
    // use HasFactory;
    use Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    public function profil()
    {
        return $this->hasOne(Profil::class);
    }
}


