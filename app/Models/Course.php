<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'instructor_id',
        'category_id',
        'course_level_id',
        'course_language_id',

        'course_type',
        'title',
        'slug',
        'seo_description',
        'description',

        'thumbnail',
        'demo_video_storage',
        'demo_video_source',

        'duration',
        'time_zone',
        'capacity',

        'price',
        'discount',

        'certificate',
        'qna',

        'message_for_reviewer',
        'is_approved',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category_id', 'id');
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(CourseLevel::class, 'course_level_id', 'id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(CourseLanguage::class, 'course_language_id', 'id');
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(CourseChapter::class, 'course_id', 'id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(CourseChapterLesson::class, 'course_id', 'id');
    }

    // public function reviews(): HasMany
    // {
    //     return $this->hasMany(Review::class, 'course_id', 'id');
    // }
}
