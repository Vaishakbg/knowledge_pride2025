<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OnlineAccess extends Model
{
    use HasFactory;

    protected $table = 'online_access'; // Explicitly defining the table name

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    /**
     * Get the user associated with this online access.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course associated with this online access.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
