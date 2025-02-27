<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'course_id',
        'country',
        'type',
        'city',
        'trainer_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'std_price',
        'currency_id',
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

    // Relationship Definitions
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
