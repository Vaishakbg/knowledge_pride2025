<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trainer extends Model
{
    use HasFactory;

    protected $table = 'trainers';

    protected $fillable = [
        'name',
        'email',
        'alt_email',
        'phone',
        'alt_phone',
        'image',
        'country_id',
        'city_id',
        'about',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
