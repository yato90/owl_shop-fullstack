<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
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
}
