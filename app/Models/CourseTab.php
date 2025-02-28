<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTab extends Model
{
    use HasFactory;
    
    protected $fillable = ['course_id', 'title', 'icon_class', 'html_content'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

