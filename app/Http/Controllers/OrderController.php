<?php

// OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
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
