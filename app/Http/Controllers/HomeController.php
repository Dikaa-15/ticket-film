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
        // Ambil film berdasarkan slug
        $film = Film::where('slug', $slug)->firstOrFail();

        //

        return view('film.show', compact('film'));
    }

    public function showtime($slug)
    {
        // Ambil film berdasarkan slug
        $film = Film::where('slug', $slug)->firstOrFail();

        // Ambil showtimes berdasarkan film yang dipilih
        $showtimes = $film->showtimes()
            ->with(['studio.bioskop'])
            ->orderBy('show_date')
            ->orderBy('show_time')
            ->where('show_date', '>=', Carbon::now())
            ->where('show_time', '>=', Carbon::now()->format('H:i:s'))
            // ->groupBy('show_date')
            ->selectRaw('show_date, show_time, end_time, price, studio_id, film_id')
            ->get();

        return view('showtimes.index', compact('film', 'showtimes'));
    }
}
