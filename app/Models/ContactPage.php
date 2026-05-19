<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = [
        'icon_one',
        'title_one',
        'subtitle_one',
        'icon_two',
        'title_two',
        'subtitle_two',
        'icon_three',
        'title_three',
        'subtitle_three',
        'icon_four',
        'title_four',
        'subtitle_four',
        'image',
        'map_link'
    ];
}
