<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'bioskop_id',
    ];

    public function bioskop()
    {
        return $this->belongsTo(Bioskop::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function seat()
    {
        return $this->hasMany(Seat::class);
    }

    // App\Models\Studio.php
    protected static function booted()
    {
        static::created(function ($studio) {
            // Generate kursi hanya jika belum ada
            if ($studio->seat()->count() === 0 && $studio->bioskop) {
                for ($row = 'A'; $row <= 'E'; $row++) {
                    for ($number = 1; $number <= 10; $number++) {
                        \App\Models\Seat::create([
                            'studio_id'   => $studio->id,
                            'bioskop_id'  => $studio->bioskop->id,
                            'seat_number' => $row . $number,
                            'is_available' => true,
                        ]);
                    }
                }
            }
        });
    }
}
