<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use App\Models\Film;
use App\Models\Studio;
use Illuminate\Http\Request;

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
            'film_id' => 'required',
            'studio_id' => 'required',
            'show_date' => 'required|date',
            'show_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        Showtime::create($request->all());
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
            'show_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        $showtime = Showtime::findOrFail($id);
        $showtime->update($request->all());
        return redirect()->route('showtime.index')->with('success', 'Showtime berhasil diperbarui');
    }

    // Menghapus showtime
    public function destroy($id)
    {
        $showtime = Showtime::findOrFail($id);
        $showtime->delete();
        return redirect()->route('showtimes.index')->with('success', 'Showtime berhasil dihapus');
    }
}
