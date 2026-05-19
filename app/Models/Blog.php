<?php

namespace App\Models;

use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{

    protected $fillable = [
        'user_id',
        'blog_category_id',
        'image',
        'title',
        'slug',
        'description',
        'status',
    ];

    function blogCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'blog_id', 'id');
    }
}
