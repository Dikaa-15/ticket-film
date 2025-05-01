<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Film;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function films()
    {

        $films = Film::where('date_release', '<=', Carbon::now())->get();
        $featuresFilms = Film::where('date_release', '>=', Carbon::now())->get();
        $trailers = Film::whereNotNull('trailer')->get();

        return view('welcome', compact('films', 'featuresFilms', 'trailers'));
    }

    public function show($slug)
    {
        $film = Film::where('slug', $slug)->firstOrFail();
        return view('film.show', compact('film'));
    }
}
