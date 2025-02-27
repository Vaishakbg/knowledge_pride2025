<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'discount_type', // 'fixed' or 'percentage'
        'discount_value',
        'expiry_date',
        'usage_limit',
        'used_count',
        'user_id', // Optional: If assigned to a specific user
        'status' // 'active', 'expired', 'used'
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'expiry_date' => 'datetime',
        'used_count' => 'integer',
    ];

    /**
     * Relationship - If the coupon is for a specific user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the coupon is valid
     */
    public function isValid(): bool
    {
        return $this->status === 'active' && 
               ($this->usage_limit === null || $this->used_count < $this->usage_limit) &&
               (is_null($this->expiry_date) || $this->expiry_date->isFuture());
    }
}
