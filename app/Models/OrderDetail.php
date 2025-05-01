<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
use SoftDeletes;
//
protected $fillable = [
    'order_id',
    'seat_id',
    'is_available',
];
public function order()
{
    return $this->belongsTo(Order::class);
}
public function seat()
{
    return $this->belongsTo(Seat::class);
}
}
