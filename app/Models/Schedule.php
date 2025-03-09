<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'course_id',
        'country_id',
        'type',
        'city_id',
        'trainer_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'std_price',
        'currency',
        'eb_price',
        'eb_date',
        'venue',
        'map',
        'no_of_participants',
        'status',
        'schedule_status',
    ];

    // Enum values for type
    public const TYPE_CLASSROOM = 'classroom';
    public const TYPE_ONLINE = 'online';
    public const TYPE_HYBRID = 'hybrid';

    // Schedule status values
    public const STATUS_UPCOMING = 'upcoming';
    public const STATUS_ONGOING = 'ongoing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public function startTime(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => date('H:i:s', strtotime($value)), // Convert to 24-hour format
            get: fn ($value) => date('h:i A', strtotime($value))  // Display in 12-hour format
        );
    }

    public function endTime(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => date('H:i:s', strtotime($value)),
            get: fn ($value) => date('h:i A', strtotime($value))
        );
    }
    // Relationship Definitions
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
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
