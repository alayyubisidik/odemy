<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialSection extends Model
{
    protected $fillable = [
        'rating',
        'review',
        'user_image',
        'user_name',
        'user_title',
    ];
}
