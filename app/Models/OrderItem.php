<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'course_id',
        'qty',
        'price',
        'commission_rate'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
