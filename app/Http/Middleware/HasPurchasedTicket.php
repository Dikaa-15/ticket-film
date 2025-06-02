<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasPurchasedTicket
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $order = Order::where('id', $request->route('order'))
            ->where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->first();

        if (!$order) {
            return redirect()->route('order.history')->with('error', 'You must purchase the ticket to view this page.');
        }

        return $next($request);
    }
}
