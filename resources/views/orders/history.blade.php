<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-main">
    <x-navbar></x-navbar>
    <div class="bg-main rounded-xl shadow-md overflow-hidden">
        <div class="grid grid-cols-12 bg-main border-b border-main/40 p-4 font-semibold text-white/90 hidden md:grid">
            <div class="col-span-2">Poster</div>
            <div class="col-span-2">Showtime</div>
            <div class="col-span-1 text-center">Tickets</div>
            <div class="col-span-2 text-right">Total Price</div>
            <div class="col-span-2 text-center">Status</div>
            <div class="col-span-2 text-center">Payment Method</div>
            <div class="col-span-1 text-center">Actions</div>
        </div>

        @forelse($orders as $order)
        <div class="grid grid-cols-1 md:grid-cols-12 p-4 border-b border-white/10 hover:bg-white/5 transition-colors duration-200">
            <div class="col-span-2 mb-2 md:mb-0">
                <img
                    src="{{ asset('storage/' . $order->showtime->film->poster) }}"
                    alt="{{ $order->showtime->film->title }}"
                    class="w-24 h-auto rounded-md shadow-md ring-1 ring-white/10">
            </div>

            <div class="col-span-2 text-white mb-2 md:mb-0">
                <div class="font-semibold">{{ $order->showtime->film->title }}</div>
                <div class="text-sm text-white/70">
                    {{ \Carbon\Carbon::parse($order->showtime->show_time)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($order->showtime->end_time)->format('H:i') }}
                </div>
            </div>

            <div class="col-span-1 text-center text-white mb-2 md:mb-0">
                {{ $order->quantity }}
            </div>

            <div class="col-span-2 text-right text-green-400 font-semibold mb-2 md:mb-0">
                Rp{{ number_format($order->total_price, 2) }}
            </div>

            <div class="col-span-2 text-center mb-2 md:mb-0">
                @php
                $statusClass = match($order->status) {
                'confirmed' => 'bg-green-500/20 text-green-300 ring-green-400/30',
                'pending' => 'bg-yellow-500/20 text-yellow-300 ring-yellow-400/30',
                'failed' => 'bg-red-500/20 text-red-300 ring-red-400/30',
                default => 'bg-gray-500/20 text-gray-300 ring-gray-400/30',
                };
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ring-1 {{ $statusClass }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="col-span-2 text-center text-white mb-2 md:mb-0">
                <span class="inline-flex items-center text-sm">
                    <i class="fas fa-wallet text-purple-400 mr-2"></i> {{ $order->payment_method }}
                </span>
            </div>

            <div class="col-span-1 flex justify-center md:justify-end">
                <button class="text-white/70 hover:text-white transition">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-white/60 bg-main">
            No transactions found.
        </div>
        @endforelse
    </div>

    <x-footer></x-footer>
</body>

</html>