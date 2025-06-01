<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Load Lucide Icons dan FontAwesome -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Load Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <x-sidebar></x-sidebar>
        <!-- Tambahin flex-1 biar sidebar dan konten imbang -->
        <div class="flex-1 p-6 overflow-y-auto mt-14">
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- CARD TOTAL USER --}}
                <div class="rounded-2xl bg-white p-4 shadow-md hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500">Total Users</h2>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
                        </div>
                        <div class="text-white bg-blue-500 p-2 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M5 20H3a4 4 0 013-3.87M15 10a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- CARD TOTAL FILM --}}
                <div class="rounded-2xl bg-white p-4 shadow-md hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500">Total Films</h2>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalFilms }}</p>
                        </div>
                        <div class="text-white bg-green-500 p-2 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 4a2 2 0 012-2h2l1 2h8l1-2h2a2 2 0 012 2v16a2 2 0 01-2 2h-2l-1-2H8l-1 2H5a2 2 0 01-2-2V4z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- CARD TOTAL ORDER --}}
                <div class="rounded-2xl bg-white p-4 shadow-md hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500">Total Transactions</h2>
                            <p class="text-2xl font-bold text-gray-800">Rp.{{ number_format($totalOrders) }}</p>
                        </div>
                        <div class="text-white bg-purple-500 p-2 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2zm0 0v8m0-8V4m0 4H4m8 0h8" />
                            </svg>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Add margin-top here to separate from cards -->
            <div class="overflow-x-auto mt-8 bg-white p-4 rounded-2xl shadow-md">
                <h2 class="text-lg font-bold mb-4">Last Orders</h2>
                <table class="min-w-full divide-y-2 divide-gray-200">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr class="*:font-medium *:text-gray-900">
                            <th class="px-3 py-2 whitespace-nowrap">#</th>
                            <th class="px-3 py-2 whitespace-nowrap">User</th>
                            <th class="px-3 py-2 whitespace-nowrap">Showtime</th>
                            <th class="px-3 py-2 whitespace-nowrap">Qty</th>
                            <th class="px-3 py-2 whitespace-nowrap">Total</th>
                            <th class="px-3 py-2 whitespace-nowrap">Payment</th>
                            <th class="px-3 py-2 whitespace-nowrap">Status</th>
                            <th class="px-3 py-2 whitespace-nowrap">Created At</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 *:even:bg-gray-50">
                        @foreach ($orders as $order)
                        <tr class="*:text-gray-900 *:first:font-medium">
                            <td class="px-3 py-2 whitespace-nowrap">{{ $order->order_number }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                {{ $order->showtime->film->title ?? 'N/A' }}<br>
                                <small class="text-gray-500">{{ $order->showtime->show_time ?? '-' }}</small>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $order->quantity }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ ucfirst($order->payment_method) }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $order->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $order->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>