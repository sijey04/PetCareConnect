<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'breed',
        'weight',
        'height',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 