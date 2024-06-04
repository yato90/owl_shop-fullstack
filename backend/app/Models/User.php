<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'email', 
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function basket()
    {
        return $this->hasOne(Basket::class);
    }
    public function ratings()
    {
        return $this->hasMany(RatingUser::class);
    }
}
