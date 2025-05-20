<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'is_available',
        'studio_id',
        'bioskop_id',
        'seat_number',
    ];
    
    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
    public function bioskop()
    {
        return $this->belongsTo(Bioskop::class);
    }
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public static function checkAvailability($studio_id, $seat_number)
    {
        return !self::where('studio_id', $studio_id)
            ->where('seat_number', $seat_number)
            ->whereHas('orderdetail', function ($q) {
                $q->where('is_available', false);
            })->exists();
    }

    public function getLabelAttribute()
    {
        return "{$this->bioskop->name} - {$this->studio->name} - Seat {$this->seat_number}";
    }
}
