<?php

namespace App\Http\Controllers;

use App\Models\Bioskop;
use Illuminate\Http\Request;

class BioskopController extends Controller
{
    public function index()
    {
        $bioskops = Bioskop::all();
        return view('admin.bioskop.index', compact('bioskops'));
    }

    public function create()
    {
        return view('admin.bioskop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
        ]);

        Bioskop::create($request->all());

        return redirect()->route('bioskop.index')->with('success', 'Bioskop berhasil ditambahkan!');
    }

    public function edit(Bioskop $bioskop)
    {
        return view('admin.bioskop.edit', compact('bioskop'));
    }

    public function update(Request $request, Bioskop $bioskop)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
        ]);

        $bioskop->update($request->all());

        return redirect()->route('bioskop.index')->with('success', 'Bioskop berhasil diperbarui!');
    }

    public function destroy(Bioskop $bioskop)
    {
        $bioskop->delete();
        return redirect()->route('bioskop.index')->with('success', 'Bioskop berhasil dihapus!');
    }
}
