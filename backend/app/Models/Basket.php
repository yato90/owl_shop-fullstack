<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Basket;

class Basket extends Model
{
    protected $fillable = [
        'user_id',
        'deactivated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function basket_stuff()
    {
        return $this->hasMany(Basket_stuff::class);
    }
    public function isActive()
    {
        return is_null($this->deactivated_at);
    }
}
