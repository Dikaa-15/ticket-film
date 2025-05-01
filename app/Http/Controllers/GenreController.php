<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    // Tampilkan semua genre
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index', compact('genres'));
    }

    // Tampilkan form create
    public function create()
    {
        return view('admin.genre.create');
    }

    // Simpan genre baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Genre::create([
            'name' => $request->name
        ]);

        return redirect()->route('genre.index')->with('success', 'Genre berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    }

    // Update genre
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $genre->update([
            'name' => $request->name
        ]);

        return redirect()->route('genre.index')->with('success', 'Genre berhasil diupdate!');
    }

    // Hapus genre
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genre.index')->with('success', 'Genre berhasil dihapus!');
    }
}
