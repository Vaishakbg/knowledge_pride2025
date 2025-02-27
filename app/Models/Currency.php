<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies'; // Explicitly defining the table name

    protected $fillable = [
        'country', 
        'code', 
        'symbol',
        'rate'
    ];

    protected $casts = [
        'rate' => 'decimal:2', // Ensure 'rate' is always treated as a decimal with 2 decimal places
    ];

    /**
     * Format currency for display.
     */
    public function format($amount)
    {
        return $this->symbol . ' ' . number_format($amount, 2);
    }
}
