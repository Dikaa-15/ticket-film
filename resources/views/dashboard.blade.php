<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;main;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        main: '#02003C',

                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <!-- Styles / Scripts -->
</head>

<body>
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <header class="flex items-center justify-between mb-8">
            {{-- Logo dan Home --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="text-3xl font-bold bg-gradient-to-r from-400 to-main bg-clip-text text-transparent flex items-center gap-2">
                    <img src="{{ asset('logos/logo-64-big.png') }}" alt="Logo" width="50">
                    <!-- Optional text branding -->
                    <span class="hidden sm:inline">CinemaKu</span>
                </a>
            </div>

            {{-- Tombol History --}}
            <div>
                <a href="{{ route('order.history') }}" class="inline-block px-4 py-2 rounded-lg bg-main text-white hover:bg-main/80 transition duration-200">
                    History Pemesanan
                </a>
            </div>
        </header>


        <!-- User Profile Summary -->
        <section class="mb-10">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 p-6 rounded-2xl shadow-lg">
                <div class="relative">
                    <img src="{{ asset('storage/'.$user->poto || 'Not Poto yet') }}" alt="User avatar" class="w-20 h-20 rounded-full border-2 border-main object-cover">
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-400">{{ $user->email }}</p>
                    <p class="text-gray-400">{{ $user->phone }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-6 py-3 bg-red-500 hover:bg-red/90 text-red-300 font-medium rounded-full transition-all transform hover:scale-105 active:scale-95 shadow-md">
                        Logout
                    </button>
                </form>

            </div>
        </section>

        <!-- Quick Statistics -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Your Movie Stats
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Tickets -->
                <div class=" p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Total Tickets</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $totalTickets }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-main/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                    </div>

                </div>

                <!-- Total Spent -->
                <div class=" p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Total Spent</p>
                            <h3 class="text-3xl font-bold mt-2">Rp{{ number_format($totalSpent, 2) }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-main/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                </div>

                <!-- Favorite Genre -->
                <div class=" p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Favorite Genre</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $topGenre->name ?? '-' }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-main/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Upcoming Tickets -->
        <section>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Upcoming Tickets
                </h2>
                <button class="text-main hover:text-400 flex items-center gap-1 transition-colors">
                    <span>View All</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="space-y-8">
                @foreach ($orders as $showDate => $groupedOrders)
                <div>
                    <h2 class="text-xl font-bold text-gray-main mb-4 border-b border-gray-600 pb-1">
                        Tayang: {{ \Carbon\Carbon::parse($showDate)->translatedFormat('l, d M Y') }}
                    </h2>

                    <div class="space-y-4">
                        @foreach ($groupedOrders as $order)
                        <div class="rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="text-lg font-bold">{{ $order->showtime->film->title }}</h3>
                                            <span class="bg-main/10 text-main text-xs px-2 py-1 rounded-full">
                                                {{ $order->showtime->studio->name }}
                                            </span>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400">
                                            <div class="flex items-center gap-1">
                                                <x-heroicon-o-calendar class="h-4 w-4" />
                                                <span>{{ $order->showtime->show_date }} • {{ \Carbon\Carbon::parse($order->showtime->show_time)->format('H:i') }} WIB</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>{{ $order->showtime->studio->bioskop->name }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <x-heroicon-o-ticket class="h-4 w-4" />
                                                <span>{{ $order->quantity }} tiket</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

        </section>
    </div>
</body>

</html>