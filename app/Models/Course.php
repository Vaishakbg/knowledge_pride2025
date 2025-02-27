<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;
    
    protected $table = 'courses'; // Explicit table name (optional)

    protected $fillable = [
        'course_full_name', 
        'slug', 
        'course_short_name', 
        'category_id', 
        'image', 
        'is_active',
        'admin_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
