<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'address',
        'image',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            return 'images/default-shop.png'; // Create a default image
        }
        
        return Storage::url($value);
    }
} 