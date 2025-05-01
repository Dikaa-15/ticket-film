<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Seat;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    // Menampilkan daftar order details
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return view('admin.orderdetail.index', compact('orderDetails'));
    }

    // Menampilkan form untuk membuat order detail baru
    public function create()
    {
        $orders = Order::all();
        $seats = Seat::all();
        return view('admin.orderdetail.create', compact('orders', 'seats'));
    }

    // Menyimpan order detail baru
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'seat_id' => 'required|exists:seats,id',
            'is_available' => 'required|boolean',
        ]);

        OrderDetail::create($request->all());

        return redirect()->route('orderdetail.index')->with('success', 'Order Detail berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit order detail
    public function edit($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orders = Order::all();
        $seats = Seat::all();
        return view('admin.orderdetail.edit', compact('orderDetail', 'orders', 'seats'));
    }

    // Mengupdate order detail yang sudah ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'seat_id' => 'required|exists:seats,id',
            'is_available' => 'required|boolean',
        ]);

        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->update($request->all());

        return redirect()->route('orderdetail.index')->with('success', 'Order Detail berhasil diperbarui');
    }

    // Menghapus order detail
    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();

        return redirect()->route('orderdetail.index')->with('success', 'Order Detail berhasil dihapus');
    }
}
