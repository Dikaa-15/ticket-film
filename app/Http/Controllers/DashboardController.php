<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use App\Models\Order;
use App\Models\Bioskop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalUsers = User::count();
        $totalFilms = Film::count();
        $totalOrders = Order::sum('total_price');
        $orders = Order::with(['user', 'showtime.film'])
            ->latest()
            ->take(5) // ambil 5 order terbaru
            ->get();

        return view('admin', compact('totalUsers', 'totalFilms', 'totalOrders', 'orders'));
    }

}
