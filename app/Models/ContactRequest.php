<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $table = 'contact_requests'; // Renamed for clarity

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'message',
        'type',
        'status',
    ];

    protected $casts = [
        'type' => 'string', // Enum: 'general', 'callback', 'support'
        'status' => 'string', // Enum: 'pending', 'resolved', 'spam'
    ];

    /**
     * Relationship - Link to User if available
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
