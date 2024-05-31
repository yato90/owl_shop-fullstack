<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'stuff_id', 'user_id', 'rating'
    ];

    public function stuff()
    {
        return $this->belongsTo(Stuff::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
