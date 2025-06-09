<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films-Page</title>

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

<body class="bg-main">
    <x-navbar></x-navbar>
    @foreach ($genres as $genre)
    <div class="bg-main mt-10">
        <div class="flex items-center justify-between px-5 md:px-20">
            <h2 class="text-xl font-bold text-white uppercase">{{ $genre->name }}</h2>
        </div>

        <div class="w-full overflow-hidden bg-main">
            <div class="carousel carousel-center rounded-box max-w-full space-x-4 px-5 md:px-20 py-6 overflow-x-auto">
                @forelse ($genre->films as $film)
                <a href="{{ route('user.film.show', $film->slug) }}"
                    class="carousel-item block relative group w-64 rounded-box overflow-hidden">
                    <img src="{{ Storage::url($film->poster) }}" alt="{{ $film->title }}"
                        class="rounded-box w-full h-96 object-cover" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-box">
                    </div>
                </a>
                @empty
                <p class="text-white">Belum ada film untuk genre {{ $genre->name }}.</p>
                @endforelse
            </div>
        </div>
    </div>
    @endforeach
    <x-footer></x-footer>
</body>

</html>