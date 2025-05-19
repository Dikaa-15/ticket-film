<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- Flowbite CDN -->

    <!-- Daisy UI CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <!--Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Styles / Scripts -->
    @vite('resources/css/app.css', 'resources/js/app.js')

</head>

<body class="bg-main w-full h-full pt-5">
    <x-navbar></x-navbar>
    <x-search></x-search>
    <x-carousel></x-carousel>

    <!-- List Film Sedang Tayang -->
    <div>
        <div class="flex items-center justify-between px-5 md:px-20">
            <h2 class="text-xl font-bold text-white">NOW SHOWING</h2>

            <a href="#" class="flex items-center gap-1 text-sm text-white hover:underline">
                Lihat Semua
                <i class="fas fa-circle-chevron-right text-white"></i>
            </a>
        </div>

        <div class="w-full overflow-hidden">
            <div class="carousel carousel-center rounded-box max-w-full space-x-4 px-5 md:px-20 py-6 overflow-x-auto">
                @forelse ($films as $film)
                <a href="{{ route('film.show', $film->slug) }}" class="carousel-item block relative group w-64 rounded-box overflow-hidden">
                    <img src="{{ Storage::url($film->poster) }}" alt="{{ $film->title }}"
                        class="rounded-box w-full h-96 object-cover" />
                    <!-- overlay hitam transparan -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-box">
                    </div>
                </a>
                @empty
                <p class="text-white">Tidak ada film tersedia.</p>
                @endforelse
            </div>
        </div>

    </div>


    <!-- List Film Segera Tayang -->
    <div>
        <div class="flex items-center justify-between px-5 md:px-20">
            <h2 class="text-xl font-bold text-white">FUTURE SHOWING</h2>

            <a href="#" class="flex items-center gap-1 text-sm text-white hover:underline">
                Lihat Semua
                <i class="fa-duotone fa-solid fa-circle-chevron-right"
                    style="--fa-primary-color: #02003c; --fa-secondary-color: #ff8c00;"></i> </a>
        </div>


        <div class="w-full overflow-hidden">
            <div class="carousel carousel-center rounded-box max-w-full space-x-4 px-5 md:px-20 py-6 overflow-x-auto">
                @forelse ($featuresFilms as $film)
                <a href="{{ route('film.show', $film->slug) }}" class="carousel-item block relative group w-64 rounded-box overflow-hidden">
                    <img src="{{ Storage::url($film->poster) }}" alt="{{ $film->title }}"
                        class="rounded-box w-full h-96 object-cover" />
                    <!-- overlay hitam transparan -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-box">
                    </div>
                </a>
                @empty
                <p class="text-white">There's no film available.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Trailer Section -->
    <div x-data="{ open: false, videoId: null }" class="relative z-10">
        <div class="flex items-center justify-between mx-6 md:mx-20 mt-10">
            <h2 class="text-lg font-semibold text-white">Cuplikan Trailer</h2>
        </div>

        <div class="overflow-x-auto px-4 md:px-10">
            <div class="flex gap-4 py-5">
                @forelse ($trailers as $film)
                @php
                preg_match('/v=([^&]+)/', $film->trailer, $matches);
                $videoId = $matches[1] ?? null;
                @endphp

                @if ($videoId)
                <div class="min-w-[280px] md:min-w-[320px] h-[180px] bg-black rounded-lg overflow-hidden shadow-md cursor-pointer"
                    @click="open = true; videoId = '{{ $videoId }}'">
                    <iframe class="w-full h-full pointer-events-none"
                        src="https://www.youtube.com/embed/{{ $videoId }}" title="Trailer"
                        frameborder="0" allowfullscreen>
                    </iframe>
                </div>
                @endif
                @empty
                <p class="text-white">Tidak ada trailer tersedia.</p>
                @endforelse
            </div>
        </div>

        <!-- Modal Popup -->
        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 z-50"
            x-transition>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl max-w-2xl w-full relative">
                <button @click="open = false; videoId = null"
                    class="absolute top-2 right-2 text-gray-700 hover:text-black text-2xl">&times;</button>
                <iframe x-bind:src="`https://www.youtube.com/embed/${videoId}?autoplay=1`" class="w-full h-[400px]"
                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>


    





    <x-footer></x-footer>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>

</html>