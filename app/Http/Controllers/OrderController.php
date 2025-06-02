<?php

// OrderController.php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\User;
use App\Models\Order;
use App\Models\Showtime;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();

        return redirect()->back()->with('success', 'Order berhasil dikonfirmasi!');
    }

    public function finalize(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:show_times,id',
            'seat_ids' => 'required|array|min:1',
            'payment_method' => 'required|string|in:manual,bca,e-wallet',
            'proof_payment' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $showtime = Showtime::findOrFail($request->showtime_id);
        $seats = Seat::whereIn('id', $request->seat_ids)->get();
        $totalPrice = count($seats) * $showtime->price;
        $pricePerTicket = $showtime->film->price;

        // Handle bukti pembayaran
        $proofPath = null;
        if ($request->hasFile('proof_payment')) {
            $proofPath = $request->file('proof_payment')->store('proofs', 'public');
        }


        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => auth()->id(),
            'showtime_id' => $showtime->id,
            'quantity' => count($seats),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'proof_payment' => $proofPath,
        ]);

        foreach ($seats as $seat) {
            OrderDetail::create([
                'order_id' => $order->id,
                'seat_id' => $seat->id,
                'is_available' => false,
            ]);

            $seat->update(['is_available' => false]);
        }

        return redirect()->route('order.success', ['order' => $order->id]);
    }

    public function success($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', auth()->id()) // memastikan hanya user yg punya order ini
            ->firstOrFail();

        if ($order->status !== 'pending') {
            abort(403, 'Access denied. You have not completed the ticket purchase.');
        }

        return view('orders.success', compact('order'));
    }


    public function history(Request $request)
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('orders.history', compact('orders'));
    }


    public function index()
    {
        $orders = Order::with(['user', 'showtime'])->latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $showtimes = Showtime::all();
        return view('admin.order.create', compact('users', 'showtimes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'showtime_id' => 'required|exists:show_times,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled',
            'payment_method' => 'required|string',
        ]);

        $data = $request->all();
        $data['order_number'] = Order::generateOrderCode();

        Order::create($data);

        return redirect()->route('order.index')->with('success', 'Order berhasil dibuat!');
    }

    public function edit(Order $order)
    {
        $users = User::all();
        $showtimes = Showtime::all();
        return view('admin.order.edit', compact('order', 'users', 'showtimes'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'showtime_id' => 'required|exists:show_times,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled',
            'payment_method' => 'required|string',
        ]);

        $order->update($request->all());

        return redirect()->route('order.index')->with('success', 'Order berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order berhasil dihapus!');
    }
}
