<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Rating;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    // Menampilkan daftar film
    public function index()
    {
        $films = Film::all();
        return view('admin.film.index', compact('films'));
    }

    // Menampilkan form untuk membuat film baru
    public function create()
    {
        $genres = Genre::all();
        return view('admin.film.create', compact('genres'));
    }

    // Menyimpan film baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|date_format:H:i',
            'synopsis' => 'required|string',
            'director' => 'required|string|max:255',
            'date_release' => 'required|date',
            'poster' => 'nullable|image|max:2048',
            'trailer' => 'nullable|url',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
        ]);

        // Simpan poster jika ada
        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        // Simpan data film
        $film = Film::create([
            'title' => $validated['title'],
            'duration' => $validated['duration'],
            'synopsis' => $validated['synopsis'],
            'director' => $validated['director'],
            'date_release' => $validated['date_release'],
            'poster' => $validated['poster'] ?? null,
            'trailer' => $validated['trailer'] ?? null,
        ]);

        // Simpan relasi genre
        $film->genres()->attach($validated['genre_ids']);

        return redirect()->route('film.index')->with('success', 'Film berhasil ditambahkan!');
    }

    // Menampilkan detail film
    public function show($slug)
    {
        $film = Film::where('slug', $slug)->firstOrFail();
        return view('film.show', compact('film'));
    }

    public function edit($id)
    {
        $film = Film::with('genres')->findOrFail($id);
        $genres = Genre::all();
        $filmGenreIds = $film->genres->pluck('id')->toArray();

        return view('admin.film.edit', compact('film', 'genres', 'filmGenreIds'));
    }


    // Menyimpan perubahan pada film yang sudah ada
    public function update(Request $request, Film $film)
    {

        $request->merge([
            'duration' => substr($request->duration, 0, 5) // ambil hanya H:i dari H:i:s
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|date_format:H:i', // langsung pakai format waktu
            'synopsis' => 'required|string',
            'director' => 'required|string|max:255',
            'date_release' => 'required|date',
            'poster' => 'nullable|image|max:2048',
            'trailer' => 'nullable|url',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');

            // Hapus poster lama kalau ada
            if ($film->poster && file_exists(storage_path('app/public/' . $film->poster))) {
                unlink(storage_path('app/public/' . $film->poster));
            }
        }

        // Update film
        $film->update([
            'title' => $validated['title'],
            'duration' => $validated['duration'],
            'synopsis' => $validated['synopsis'],
            'director' => $validated['director'],
            'date_release' => $validated['date_release'],
            'poster' => $validated['poster'] ?? $film->poster,
            'trailer' => $validated['trailer'] ?? null,
        ]);

        // Update genre relasi
        $film->genres()->sync($validated['genre_ids']);

        return redirect()->route('film.index')->with('success', 'Film berhasil diperbarui!');
    }




    // Menghapus film
    public function destroy($id)
    {
        $film = Film::findOrFail($id);

        // Hapus poster jika ada
        if ($film->poster) {
            unlink(storage_path('app/public/' . $film->poster));
        }

        $film->delete();

        return redirect()->route('film.index')->with('success', 'Film berhasil dihapus.');
    }
}
