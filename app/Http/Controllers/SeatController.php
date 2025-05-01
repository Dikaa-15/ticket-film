<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Studio;
use App\Models\Bioskop;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::with(['studio', 'bioskop'])
        ->latest()
        ->paginate(10);
        return view('admin.seat.index', compact('seats'));
    }

    public function create()
    {
        $studios = Studio::all();
        $bioskops = Bioskop::all();
        return view('admin.seat.create', compact('studios', 'bioskops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'is_available' => 'required|boolean',
            'studio_id' => 'required|exists:studios,id',
            'bioskop_id' => 'required|exists:bioskops,id',
            'seat_number' => 'required|string|max:10',
        ]);

        Seat::create($request->all());

        return redirect()->route('seat.index')->with('success', 'Seat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $seat = Seat::findOrFail($id);
        $studios = Studio::all();
        $bioskops = Bioskop::all();
        return view('admin.seat.edit', compact('seat', 'studios', 'bioskops'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'is_available' => 'required|boolean',
            'studio_id' => 'required|exists:studios,id',
            'bioskop_id' => 'required|exists:bioskops,id',
            'seat_number' => 'required|string|max:10',
        ]);

        $seat = Seat::findOrFail($id);
        $seat->update($request->all());

        return redirect()->route('seat.index')->with('success', 'Seat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $seat = Seat::findOrFail($id);
        $seat->delete();

        return redirect()->route('seat.index')->with('success', 'Seat berhasil dihapus.');
    }
}
