<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseChapterLesson extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'instructor_id',
        'course_id',
        'chapter_id',
        'file_path',
        'storage',
        'volume',
        'duration',
        'file_type',
        'downloadable',
        'order',
        'is_preview',
        'is_active',
        'lesson_type',
    ];
}
