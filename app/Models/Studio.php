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

    
}
