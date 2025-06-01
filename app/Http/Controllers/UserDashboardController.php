<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $now = Carbon::now();

        $orders = Order::where('user_id', $user->id)
            ->whereHas('showtime', function ($query) use ($now) {
                $query->where(function ($q) use ($now) {
                    $q->where('show_date', '>', $now->toDateString())
                        ->orWhere(function ($q2) use ($now) {
                            $q2->where('show_date', '=', $now->toDateString())
                                ->where('show_time', '>=', $now->toTimeString());
                        });
                });
            })
            ->with(['showtime.film', 'showtime.studio'])
            ->latest()
            ->get()
            ->groupBy(function ($order) {
                return $order->showtime->show_date;
            });

        $totalTickets = $orders->flatten()->sum('quantity');
        $totalSpent = $orders->flatten()->sum('total_price');

        $favoriteGenres = DB::table('orders')
            ->where('orders.user_id', Auth::id())
            ->join('show_times', 'orders.showtime_id', '=', 'show_times.id')
            ->join('films', 'show_times.film_id', '=', 'films.id')
            ->join('film_genre', 'films.id', '=', 'film_genre.film_id') // pivot join
            ->join('genres', 'film_genre.genre_id', '=', 'genres.id')
            ->select('genres.name', DB::raw('COUNT(*) as total'))
            ->groupBy('genres.name')
            ->orderByDesc('total')
            ->get();

        $topGenre = $favoriteGenres->first();


        return view('dashboard', compact('user', 'orders', 'totalTickets', 'totalSpent', 'favoriteGenres', 'topGenre'));
    }
}
