<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Film</title>

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

<body class="bg-main text-white font-sans">

    <x-navbar></x-navbar>

    <!-- Section Poster + Info -->
    <div class="relative w-full overflow-hidden">
        <!-- Background Poster Blur -->
        <img src="{{ Storage::url($film->poster) }}"
            alt="{{ $film->title }}"
            class="w-full h-full object-cover opacity-30 absolute top-0 left-0 z-0" />


        <!-- Konten Utama -->
        <div class="relative z-10 flex items-center min-h-[90vh] bg-black/50 backdrop-blur-xs">
            <div class="container mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-[320px_1fr] gap-10">

                <!-- Poster Film -->
                <div class="rounded-xl overflow-hidden shadow-lg w-80">
                    <img src="{{ Storage::url($film->poster) }}"
                        alt="{{ $film->title }}"
                        class="w-full h-[500px] object-cover object-center" />
                </div>

                <!-- Info Film -->
                <div class="text-white">
                    <h1 class="text-4xl font-bold mb-6 leading-tight tracking-wide">
                        {{ $film->title }}
                    </h1>

                    <p class="text-base leading-relaxed mb-6 text-justify">
                        <span class="font-semibold text-lg block mb-1">Synopsis:</span>
                        {{ $film->synopsis }}
                    </p>

                    <ul class="space-y-2 text-sm leading-relaxed">
                        <li><span class="font-semibold">Director:</span> {{ $film->director ?? 'Tidak diketahui' }}</li>
                        <li>
                            @php
                            use Carbon\Carbon;
                            $time = Carbon::createFromFormat('H:i:s', $film->duration);
                            $jam = (int) $time->format('H');
                            $menit = (int) $time->format('i');
                            @endphp
                            <span class="font-semibold">Duration:</span> {{ $jam }} jam {{ $menit }} menit
                        </li>
                        <li>
                            <span class="font-semibold">Release Date:</span>
                            {{ \Carbon\Carbon::parse($film->date_release)->translatedFormat('d F Y') }}
                        </li>
                    </ul>

                    <!-- Tombol Aksi -->
                    <div class="mt-8">
                        <div class="flex flex-wrap gap-4">
                            <!-- Modal Video Trailer -->
                            <!-- Modal Video Trailer -->
                            <div x-data="{ open: false, trailerUrl: '{{ Str::replace('watch?v=', 'embed/', $film->trailer) }}', tempUrl: '' }">
                                <!-- Tombol Watch Trailer -->
                                <a href="#"
                                    @click.prevent="open = true; tempUrl = trailerUrl"
                                    class="inline-flex items-center gap-2 bg-white hover:bg-main text-main hover:text-white px-6 py-2 rounded-lg font-semibold shadow transition">
                                    <i class="fas fa-play-circle"></i> Watch Trailer
                                </a>

                                <!-- Modal -->
                                <div x-show="open"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
                                    x-cloak>
                                    <div class="relative bg-white rounded-xl overflow-hidden w-full max-w-3xl aspect-video shadow-lg">
                                        <!-- Tombol Close -->
                                        <button @click="open = false; tempUrl = ''"
                                            class="absolute top-2 right-2 text-gray-800 hover:text-red-600 text-xl z-10">
                                            &times;
                                        </button>
                                        <!-- YouTube Embed -->
                                        <template x-if="tempUrl">
                                            <iframe class="w-full h-full"
                                                :src="tempUrl"
                                                title="YouTube Trailer"
                                                frameborder="0"
                                                allowfullscreen
                                                allow="autoplay">
                                            </iframe>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('film.showtime', $film->slug) }}"
                                class="inline-flex items-center gap-2 bg-main hover:bg-white text-white hover:text-main px-6 py-2 rounded-lg font-semibold shadow transition">
                                <i class="fas fa-ticket-alt"></i> Buy Tickets
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4 text-center mt-5">Showtimes for - {{ $film->title }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10 mx-4">
        @foreach ($showtimes as $showtime)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-5 hover:shadow-lg transition duration-300">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $showtime->studio->bioskop->name }}</h2>
                <p class="text-sm text-gray-500">Studio: {{ $showtime->studio->name }}</p>
            </div>

            <div class="text-sm text-gray-700 space-y-1">
                <p><span class="font-medium">Tanggal:</span> {{ \Carbon\Carbon::parse($showtime->show_date)->format('d M Y') }}</p>
                <p><span class="font-medium">Jam:</span> {{ $showtime->show_time }} - {{ $showtime->end_time }}</p>
                <p><span class="font-medium">Harga:</span> <span class="text-green-600 font-semibold">Rp{{ number_format($showtime->price) }}</span></p>
            </div>

            <div class="mt-4">
                <a href="#"
                    class="w-full inline-block text-center bg-main text-white font-semibold py-2 px-4 rounded-lg hover:bg-white hover:text-main transition duration-200">
                    Pilih Kursi
                </a>
            </div>
        </div>
        @endforeach
    </div>


    <x-footer></x-footer>

</body>

</html>