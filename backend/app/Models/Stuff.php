<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $fillable = [
        'name',
        'price', 
        'img',
        'type',
        'rating',
    ];


    public function basket_stuff()
    {
        return $this->hasOne(Basket_stuff::class);
    }
}
