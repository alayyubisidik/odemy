<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureSection extends Model
{
      protected $fillable = [
        'image_one',
        'title_one',
        'subtitle_one',
        'image_two',
        'title_two',
        'subtitle_two',
        'image_three',
        'title_three',
        'subtitle_three',
    ];
}
