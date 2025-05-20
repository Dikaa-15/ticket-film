<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Order;
use App\Models\Showtime;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SeatSelectionController extends Controller
{
    //
    public function index($id)
    {
        $showtime = Showtime::with(['studio.bioskop'])->findOrFail($id);
        $seats = Seat::where('studio_id', $showtime->studio_id)
            ->orderBy('seat_number')
            ->get();

        $bookedSeatIds = OrderDetail::whereHas('order', function ($q) use ($id) {
            $q->where('showtime_id', $id)
                ->whereIn('status', ['pending', 'paid']); // Status mana aja yang dianggap BOOKED
        })->pluck('seat_id')->toArray();

        return view('seats.index', compact('showtime', 'seats', 'bookedSeatIds'));
    }

    public function book(Request $request, $id)
    {
        $request->validate([
            'seats' => 'required|array|min:1',
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'order_number' => Order::generateOrderCode(),
                'user_id' => Auth::id(),
                'showtime_id' => $id,
                'quantity' => count($request->seats),
                'total_price' => count($request->seats) * 35000, // Atur sesuai harga
                'status' => 'pending',
                'payment_method' => 'manual',
            ]);

            foreach ($request->seats as $seatId) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'seat_id' => $seatId,
                    'is_available' => false,
                ]);
            }

            DB::commit();
            return redirect()->route('home')->with('success', 'Kursi berhasil dipesan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
