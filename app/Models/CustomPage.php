<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'seo_title',
        'seo_description',
        'status'
    ];
}
