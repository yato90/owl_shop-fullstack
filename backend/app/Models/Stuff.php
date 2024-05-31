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
        'type_id',
        'rating',
    ];


    public function basket_stuff()
    {
        return $this->hasOne(Basket_stuff::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function ratings()
    {
        return $this->hasMany(RatingUser::class);
    }

    public function calculateRating()
    {
        $averageRating = $this->ratings()->avg('rating');
        return round($averageRating, 2);
    }
    public function info()
    {
        return $this->hasMany(StuffInfo::class);
    }
}
