<?php

namespace App\Http\Controllers;

use App\Models\FilmBioskop;
use App\Models\Film;
use App\Models\Bioskop;
use Illuminate\Http\Request;

class FilmBioskopController extends Controller
{
    public function index()
    {
        $filmBioskops = FilmBioskop::with(['film', 'bioskops'])->get();
        return view('ADMIN.film_bioskop.index', compact('filmBioskops'));
    }

    public function create()
    {
        $films = Film::all();
        $bioskops = Bioskop::all();
        return view('ADMIN.film_bioskop.create', compact('films', 'bioskops'));
    }
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'film_id' => 'required|exists:films,id',
            'bioskop_id' => 'required|exists:bioskops,id'
        ]);

        // Temukan film berdasarkan ID
        $film = Film::findOrFail($validated['film_id']);

        // Simpan relasi film dan bioskop ke tabel pivot (many-to-many)
        $film->bioskops()->sync([$validated['bioskop_id']]); // hanya satu bioskop yang dipilih

        return redirect()->route('filmbioskop.index')->with('success', 'Relasi Film & Bioskop berhasil ditambahkan.');
    }
    public function edit($id)
    {
        // Temukan film berdasarkan ID beserta relasi bioskopnya
        $film = Film::with('bioskops')->findOrFail($id);
        $bioskops = Bioskop::all();

        // Ambil ID bioskop yang sudah dipilih untuk film ini
        $selectedBioskops = $film->bioskops->pluck('id')->toArray();

        return view('ADMIN.film_bioskop.edit', compact('film', 'bioskops', 'selectedBioskops'));
    }
    public function update(Request $request, Film $film)
    {
        // Validasi input form untuk bioskop
        $validated = $request->validate([
            'bioskop_id' => 'required|exists:bioskops,id',
        ]);

        // Update relasi film-bioskop
        $film->bioskops()->sync([$validated['bioskop_id']]); // hanya satu bioskop yang dipilih

        return redirect()->route('filmbioskop.index')->with('success', 'Relasi Film & Bioskop berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $filmBioskop = FilmBioskop::findOrFail($id);
        $filmBioskop->delete();
        return redirect()->route('filmbioskop.index')->with('success', 'Data berhasil dihapus');
    }
}
