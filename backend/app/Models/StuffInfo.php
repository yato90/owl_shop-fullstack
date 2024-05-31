<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuffInfo extends Model
{
    protected $table = 'stuff_info';
    protected $fillable = [
        'stuff_id',
        'title',
        'description',
    ];

    public function stuff()
    {
        return $this->belongsTo(Stuff::class);
    }
}
