<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FilmGenre extends Pivot
{
    protected $table = 'film_genre'; // nama tabel pivot

    protected $fillable = [
        'film_id',
        'genre_id',
        // tambah di sini kalau ada kolom tambahan di pivot
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
