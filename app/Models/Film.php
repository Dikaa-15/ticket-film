<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'title',
        'slug',
        'rating_id',
        'duration',
        'synopsis',
        'poster',
        'trailer',
        'director',
        'date_release'
    ];
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected $casts = [
        'date_release' => 'datetime',
    ];
    public function genres()
    {
        return $this->belongsToMany(Genre::class)
            ->using(FilmGenre::class); // <- pakai model pivot-nya;
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class, 'film_id');
    }
    public function bioskops()
    {
        return $this->belongsToMany(Bioskop::class, 'film_bioskop');
    }

    public function filmbioskop()
    {
        return $this->hasMany(FilmBioskop::class);
    }




    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
