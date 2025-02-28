<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'caption', 'image_path', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

