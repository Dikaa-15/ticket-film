<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\Bioskop;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    // Tampilkan semua studio
    public function index()
    {
        $studios = Studio::with('bioskop')->get(); // relasi bioskop
        return view('admin.studio.index', compact('studios'));
    }

    // Tampilkan form tambah studio
    public function create()
    {
        $bioskops = Bioskop::all();
        return view('admin.studio.create', compact('bioskops'));
    }

    // Simpan data studio baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bioskop_id' => 'required|exists:bioskops,id',
        ]);

        Studio::create([
            'name' => $request->name,
            'bioskop_id' => $request->bioskop_id,
        ]);

        return redirect()->route('studio.index')->with('success', 'Studio berhasil ditambahkan!');
    }

    // Tampilkan form edit studio
    public function edit(Studio $studio)
    {
        $bioskops = Bioskop::all();
        return view('admin.studio.edit', compact('studio', 'bioskops'));
    }

    // Update data studio
    public function update(Request $request, Studio $studio)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bioskop_id' => 'required|exists:bioskops,id',
        ]);

        $studio->update([
            'name' => $request->name,
            'bioskop_id' => $request->bioskop_id,
        ]);

        return redirect()->route('studio.index')->with('success', 'Studio berhasil diupdate!');
    }

    // Hapus studio
    public function destroy(Studio $studio)
    {
        $studio->delete();

        return redirect()->route('studio.index')->with('success', 'Studio berhasil dihapus!');
    }
}
