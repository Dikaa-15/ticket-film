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
        $film = Film::where('slug', $slug)->first();
        if (!$film) {
            abort(404, 'Film tidak ditemukan');
        }
        return view('film.show', compact('film'));
    }


    public function showtime($slug)
    {
        $film = Film::where('slug', $slug)->firstOrFail();

        $now = Carbon::now();
        $today = $now->toDateString();
        $currentTime = $now->format('H:i:s');

        $showtimes = $film->showtimes()
            ->with(['studio.bioskop'])
            ->where(function ($query) use ($today, $currentTime) {
                $query->where('show_date', '>', $today)
                    ->orWhere(function ($query) use ($today, $currentTime) {
                        $query->where('show_date', $today)
                            ->where('show_time', '>=', $currentTime);
                    });
            })
            ->orderBy('show_date')
            ->orderBy('show_time')
            ->selectRaw('id, show_date, show_time, end_time, price, studio_id, film_id')
            ->get();

        return view('showtimes.index', compact('film', 'showtimes'));
    }
}
