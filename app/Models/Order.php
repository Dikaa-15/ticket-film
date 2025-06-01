<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'order_number',
        'user_id',
        'showtime_id',
        'quantity',
        'total_price',
        'status',
        'payment_method',
        'proof_payment'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }
    
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public static function generateOrderCode(): string
    {
        do {
            $code = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (self::where('order_number', $code)->exists());

        return $code;
    }

}
