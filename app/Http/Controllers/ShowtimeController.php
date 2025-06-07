<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Studio;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShowtimeController extends Controller
{
    // Menampilkan daftar showtimes
    public function index()
    {
        $showtimes = Showtime::with('film', 'studio')->get();
        return view('admin.showtime.index', compact('showtimes'));
    }

    // Menampilkan form untuk membuat showtime baru
    public function create()
    {
        $films = Film::all();
        $studios = Studio::all();
        return view('admin.showtime.create', compact('films', 'studios'));
    }

    // Menyimpan showtime baru
    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'studio_id' => 'required|exists:studios,id',
            'show_date' => 'required|date',
            'show_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        $film = Film::findOrFail($request->film_id);

        // Konversi HH:MM:SS ke menit
        list($hours, $minutes, $seconds) = explode(':', $film->duration);
        $durationInMinutes = ((int)$hours * 60) + (int)$minutes;




        // Hitung end_time
        $showTime = Carbon::createFromFormat('H:i', $request->show_time);
        $endTime = $showTime->copy()->addMinutes($durationInMinutes + 15);
        Showtime::create([
            'film_id' => $request->film_id,
            'studio_id' => $request->studio_id,
            'show_date' => $request->show_date,
            'show_time' => $request->show_time,
            'end_time' => $endTime->format('H:i'),
            'price' => $request->price,
        ]);

        return redirect()->route('showtime.index')->with('success', 'Showtime berhasil ditambahkan');
    }


    // Menampilkan form untuk mengedit showtime
    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);
        $films = Film::all();
        $studios = Studio::all();
        return view('admin.showtime.edit', compact('showtime', 'films', 'studios'));
    }

    // Mengupdate showtime
    public function update(Request $request, $id)
    {
        $request->validate([
            'film_id' => 'required',
            'studio_id' => 'required',
            'show_date' => 'required|date',
            'show_time' => 'required',
            'price' => 'required|numeric',
        ]);

        $film = Film::findOrFail($request->film_id);

        // Konversi duration dari format HH:MM:SS ke menit
        list($hours, $minutes, $seconds) = explode(':', $film->duration);
        $durationInMinutes = ((int)$hours * 60) + (int)$minutes;

        // Hitung end_time
        $showTime = \Carbon\Carbon::createFromFormat('H:i', $request->show_time);
        $endTime = $showTime->copy()->addMinutes($durationInMinutes + 15);

        // Update showtime
        $showtime = Showtime::findOrFail($id);
        $showtime->update([
            'film_id' => $request->film_id,
            'studio_id' => $request->studio_id,
            'show_date' => $request->show_date,
            'show_time' => $request->show_time,
            'end_time' => $endTime->format('H:i'),
            'price' => $request->price,
        ]);

        return redirect()->route('showtime.index')->with('success', 'Showtime berhasil diperbarui');
    }


    // Menghapus showtime
    public function destroy($id)
    {
        $showtime = Showtime::findOrFail($id);
        $showtime->delete();
        return redirect()->route('showtime.index')->with('success', 'Showtime berhasil dihapus');
    }
}
