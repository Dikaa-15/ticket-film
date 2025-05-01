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

    public function order()
    {
        return $this->hasMany(Order::class, 'order_id');
    }

    public function getAvailableSeats()
    {
        return Seat::where('studio_id', $this->id_studio)
            ->whereDoesntHave('ordersDetail', function ($q) {
                $q->where('id_showtimes', $this->id_showtimes)
                    ->where('is_available', false);
            })->get();
    }

    public function getEndTime()
    {
        return Carbon::parse($this->show_time)->addMinutes($this->film->duration);
    }
}
