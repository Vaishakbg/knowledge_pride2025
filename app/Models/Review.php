<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'name',  
        'review',
        'trainer_id',
        'image',
        'rating',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // Define Relationship: A review belongs to a trainer
    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }
}
