<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket_stuff extends Model
{
    protected $fillable = [
        'name',
        'basket_id', 
        'stuff_id',
    ];

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
    public function stuff()
    {
        return $this->belongsTo(Stuff::class);
    }
}
