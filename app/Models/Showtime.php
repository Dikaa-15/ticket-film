<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showtime extends Model
{
    use SoftDeletes;

    protected $table = 'show_times';

    //
    protected $fillable = [
        'film_id',
        'studio_id',
        'show_date',
        'show_time',
        'end_time',
        'price',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
    public function bioskop()
    {
        // Biar bisa akses bioskop langsung dari showtime
        return $this->studio?->bioskop();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'showtime_id');
    }

    public function getAvailableSeats()
    {
        return Seat::where('studio_id', $this->studio_id)
            ->whereDoesntHave('orderDetails.order', function ($query) {
                $query->where('showtime_id', $this->id)
                    ->whereIn('status', ['pending', 'confirmed']);
            })
            ->get();
    }


    public function getEndTime()
    {
        return Carbon::parse($this->show_time)->addMinutes($this->film->duration);
    }
}
