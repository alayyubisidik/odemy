<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseChapter extends Model
{
    protected $fillable = [
        'title',
        'instructor_id',
        'course_id',
        'order',
        'is_active'
    ];

    public function lessons(): HasMany
    {
        return $this->hasMany(CourseChapterLesson::class, 'chapter_id', 'id')->orderBy('order');
    }
}
