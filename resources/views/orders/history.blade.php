<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        main: '#02003C',
                    },
                    boxShadow: {
                        'glass': '0 4px 30px rgba(0, 0, 0, 0.1)',
                        'inner-glass': 'inset 0 4px 30px rgba(255, 255, 255, 0.05)'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="min-h-screen p-4 md:p-8 text-gray-100">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-4 md:gap-6 mb-6">
            <div class="bg-white/10 p-2 rounded-xl shadow-lg backdrop-blur-md transition hover:scale-105 duration-300">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logos/logo-64-big.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                </a>
            </div>
            <h1 class="text-white text-2xl md:text-4xl font-extrabold tracking-tight drop-shadow-sm">
                Order History
            </h1>
        </div>


        <div class="glass-card rounded-xl shadow-glass overflow-hidden">
            <!-- Header Row -->
            <div class="grid grid-cols-12 bg-main/80 border-b border-main/40 p-4 font-semibold text-white/90 hidden md:grid">
                <div class="col-span-2 pl-6">Poster</div>
                <div class="col-span-3">Showtime</div>
                <div class="col-span-1 text-center">Tickets</div>
                <div class="col-span-2 text-right">Total</div>
                <div class="col-span-2 text-center">Status</div>
                <div class="col-span-2 text-center">Payment</div>
            </div>

            <!-- Dynamic Order Items -->
            @forelse($orders as $order)
            <div class="grid grid-cols-1 md:grid-cols-12 p-4 border-b border-white/5 hover:bg-white/5 transition-colors duration-200 hover-scale">
                <!-- Poster -->
                <div class="col-span-2 mb-4 md:mb-0 flex items-center md:pl-6">
                    <img src="{{ asset('storage/' . $order->showtime->film->poster) }}"
                        alt="{{ $order->showtime->film->title }}"
                        class="w-16 h-24 md:w-20 md:h-28 rounded-lg object-cover shadow-md ring-1 ring-white/10 hover:ring-white/30 transition-all">
                </div>

                <!-- Showtime -->
                <div class="col-span-3 text-white mb-4 md:mb-0">
                    <div class="font-semibold text-lg md:text-base">{{ $order->showtime->film->title }}</div>
                    <div class="flex flex-wrap items-center gap-2 mt-1">
                        <span class="text-sm text-white/70 bg-white/5 px-2 py-1 rounded-md">
                            <i class="fas fa-calendar-day text-blue-400 mr-1"></i>
                            {{ \Carbon\Carbon::parse($order->showtime->show_time)->format('M d, Y') }}
                        </span>
                        <span class="text-sm text-white/70 bg-white/5 px-2 py-1 rounded-md">
                            <i class="fas fa-clock text-purple-400 mr-1"></i>
                            {{ \Carbon\Carbon::parse($order->showtime->show_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($order->showtime->end_time)->format('H:i') }}
                        </span>
                    </div>
                </div>

                <!-- Tickets -->
                <div class="col-span-1 flex items-center justify-center mb-4 md:mb-0">
                    <span class="bg-white/10 text-white px-3 py-1 rounded-full text-sm font-medium">
                        {{ $order->quantity }} <span class="hidden md:inline">tickets</span>
                    </span>
                </div>

                <!-- Total Price -->
                <div class="col-span-2 flex items-center justify-end mb-4 md:mb-0">
                    <span class="text-green-400 font-semibold text-lg">
                        Rp{{ number_format($order->total_price, 2) }}
                    </span>
                </div>

                <!-- Status -->
                <div class="col-span-2 flex items-center justify-center mb-4 md:mb-0">
                    @php
                    $statusClass = match($order->status) {
                    'confirmed' => 'bg-green-500/20 text-green-300 ring-green-400/30',
                    'pending' => 'bg-yellow-500/20 text-yellow-300 ring-yellow-400/30',
                    'failed' => 'bg-red-500/20 text-red-300 ring-red-400/30',
                    default => 'bg-gray-500/20 text-gray-300 ring-gray-400/30',
                    };
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ring-1 {{ $statusClass }}">
                        @if($order->status == 'confirmed')
                        <i class="fas fa-check-circle mr-2"></i>
                        @elseif($order->status == 'pending')
                        <i class="fas fa-clock mr-2"></i>
                        @elseif($order->status == 'failed')
                        <i class="fas fa-times-circle mr-2"></i>
                        @endif
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <!-- Payment Method -->
                <div class="col-span-2 flex items-center justify-center">
                    <span class="inline-flex items-center text-sm bg-white/5 px-3 py-1 rounded-full">
                        @if(str_contains(strtolower($order->payment_method), 'credit'))
                        <i class="fab fa-cc-visa text-blue-400 mr-2"></i>
                        @elseif(str_contains(strtolower($order->payment_method), 'paypal'))
                        <i class="fab fa-paypal text-blue-500 mr-2"></i>
                        @elseif(str_contains(strtolower($order->payment_method), 'bank'))
                        <i class="fas fa-university text-purple-400 mr-2"></i>
                        @else
                        <i class="fas fa-wallet text-green-400 mr-2"></i>
                        @endif
                        <span class="hidden md:inline">{{ $order->payment_method }}</span>
                        <span class="md:hidden">{{ Str::limit($order->payment_method, 12) }}</span>
                    </span>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-white/60">
                <i class="fas fa-ticket-alt text-4xl mb-4 text-white/30"></i>
                <p class="text-xl font-medium">No transactions found</p>
                <p class="text-white/50 mt-2">Your movie tickets will appear here once purchased</p>
            </div>
            @endforelse
        </div>

        <!-- Mobile Legend -->
        <div class="md:hidden mt-4 text-sm text-white/60 flex justify-center">
            <div class="bg-white/5 p-3 rounded-lg">
                <p class="flex items-center mb-1"><span class="w-4 h-4 bg-green-400/30 rounded-full mr-2"></span> Confirmed</p>
                <p class="flex items-center mb-1"><span class="w-4 h-4 bg-yellow-400/30 rounded-full mr-2"></span> Pending</p>
                <p class="flex items-center"><span class="w-4 h-4 bg-red-400/30 rounded-full mr-2"></span> Failed</p>
            </div>
        </div>
    </div>
</body>

</html>