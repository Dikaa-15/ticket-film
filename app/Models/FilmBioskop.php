<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmBioskop extends Model
{
    //
    protected $table = 'film_bioskop'; // BUKAN 'film_bioskops'

    protected $fillable = ['film_id', 'bioskop_id'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function bioskops()
    {
        // Ubah ke belongsToMany untuk menunjukkan relasi banyak ke banyak
        return $this->belongsToMany(Bioskop::class, 'film_bioskop', 'film_id', 'bioskop_id');
    }
}
