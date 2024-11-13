<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'image',
        'rating',
        'address',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Calculate average rating
    public function calculateAverageRating()
    {
        return $this->ratings()->avg('rating') ?? 0.0;
    }

    // Update shop's rating
    public function updateRating()
    {
        $this->rating = $this->calculateAverageRating();
        $this->save();
    }
} 