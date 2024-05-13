<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $guarded = ['id'];

    public function hasRole($roleValue)
    {
        return $this->is_admin == $roleValue; // Misalkan is_admin merupakan atribut yang menunjukkan peran sebagai admin
    }
}
