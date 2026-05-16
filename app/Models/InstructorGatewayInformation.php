<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorGatewayInformation extends Model
{
    protected $fillable = [
        'gateway',
        'gateway_information',
        'instructor_id'
    ];
}
