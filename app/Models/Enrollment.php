<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollments'; // Explicitly defining the table name

    protected $fillable = [
        'course_id', 
        'user_id', 
        'schedule_id',
        'email',
        'alt_email',
        'phone',
        'alt_phone',
        'country_id',
        'city_id',
        'type'
    ];

    protected $casts = [
        'type' => 'string', // Enum values: 'direct', 'custom_payment'
    ];

    // Enum values for type
    public const TYPE_Direct = 'direct';
    public const TYPE_CUSTOM_PAYMENT = 'custom_payment';

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class); 
    }
}
