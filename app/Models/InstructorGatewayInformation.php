<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorGatewayInformation extends Model
{
    protected $table = 'instructor_gateway_informations';
    protected $fillable = [
        'gateway',
        'gateway_information',
        'instructor_id'
    ];
}
