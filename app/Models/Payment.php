<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; // Explicit table name

    protected $fillable = [
        'user_id', 
        'enrollment_id', 
        'amount', 
        'payment_method', 
        'transaction_id', 
        'status', 
        'discount', 
        'paid_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'paid_at' => 'datetime',
        'status' => 'string',
    ];

    /**
     * Relationship - User who made the payment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship - Linked Enrollment
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

}
