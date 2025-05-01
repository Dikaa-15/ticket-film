<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'slug',
    ];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    // public function films() -> ini bisa tetap kalau sebelumnya pakai many-to-one, tinggal ganti aja jadi:
    public function films()
    {
        return $this->belongsToMany(Film::class)
            ->using(FilmGenre::class); // <- pakai model pivot-nya;
    }
}
