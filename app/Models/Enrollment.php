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
        'country',
        'city',
        'type'
    ];

    protected $casts = [
        'type' => 'string', // Enum values: 'direct', 'custom_payment'
    ];

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
}
