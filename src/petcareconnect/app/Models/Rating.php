<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'shop_id',
        'user_id',
        'comment'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
} 