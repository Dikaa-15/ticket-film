<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Tailwind / DaisyUI / Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-main w-full h-full">

    <div class="max-w-4xl mx-auto py-10 text-white">
        <h2 class="text-3xl font-bold mb-8 text-center">Ringkasan Pemesanan</h2>

        <div class="bg-gray-400 backdrop-filter bg-opacity-10 backdrop-blur-sm  mb-32 rounded-xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            {{-- Bagian Poster dan Info Film --}}
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('storage/' . $showtime->film->poster) }}" alt="{{ $showtime->film->title }}" class="w-48 h-auto rounded-lg shadow-lg mb-4">
                <h3 class="text-xl font-bold">{{ $showtime->film->title }}</h3>
                <p class="text-sm text-gray-300 mt-1 italic">{{ $showtime->film->genre }} • {{ $showtime->film->duration }} menit</p>
                <p class="text-sm text-gray-400 mt-2">Disutradarai oleh <span class="text-white font-semibold">{{ $showtime->film->director }}</span></p>
            </div>

            {{-- Detail Transaksi --}}
            <div class="bg-gray-800 p-6 rounded-lg space-y-4">
                <div>
                    <h4 class="font-semibold text-lg mb-1">Tanggal & Waktu Tayang</h4>
                    <p class="text-gray-300">{{ $showtime->show_date }} • {{ $showtime->show_time }}</p>
                </div>

                <div>
                    <h4 class="font-semibold text-lg mb-1">Jumlah Tiket</h4>
                    <p class="text-gray-300">{{ count($seats) }} Tiket</p>
                </div>

                <div>
                    <h4 class="font-semibold text-lg mb-1">Nomor Kursi</h4>
                    <p class="text-gray-300">{{ implode(', ', $seats->pluck('seat_number')->toArray()) }}</p>
                </div>

                <!-- <div>
                    <h4 class="font-semibold text-lg mb-1">Harga Tiket</h4>
                    
                </div> -->

                <div class="border-t border-gray-700 pt-3">
                    <h4 class="font-bold text-xl">Total Bayar</h4>
                    <p class="text-white text-lg font-semibold">Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                </div>

                {{-- Tombol Konfirmasi --}}
                <form method="POST" action="{{ route('seat.finalize') }}" class="mt-4">
                    @csrf
                    <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                    @foreach($seats as $seat)
                    <input type="hidden" name="seat_ids[]" value="{{ $seat->id }}">
                    @endforeach
                    <div class="text-center ">
                        <button type="submit" class="bg-amber-500 font-bold hover:bg-main px-6 py-2 text-main hover:text-white font-semibold rounded-lg w-44 transition-all">
                            Buy Tickets
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>