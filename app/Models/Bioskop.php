<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bioskop extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'address',
        'contact',
    ];

    public function studio()
    {
        return $this->hasMany(Studio::class);
    }
    public function filmbioskop()
    {
        return $this->hasMany(FilmBioskop::class);
    }
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_bioskop');
    }

}
