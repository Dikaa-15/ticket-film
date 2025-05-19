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

<body>
    <x-navbar></x-navbar>
    <div class="max-w-6xl mx-auto py-10">
        <h2 class="text-2xl font-bold text-center mb-6">Pilih Kursi untuk {{ $showtime->film->title }}</h2>

        <form method="POST" action="{{ route('seat.book', $showtime->id) }}">
            @csrf
            <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                @foreach($seats as $seat)
                <label class="cursor-pointer">
                    <input type="checkbox" name="seats[]" value="{{ $seat->id }}" class="hidden"
                        {{ in_array($seat->id, $bookedSeatIds) ? 'disabled' : '' }}>
                    <div class="p-4 rounded-lg border 
                        {{ in_array($seat->id, $bookedSeatIds) ? 'bg-red-300 cursor-not-allowed' : 'bg-green-200 hover:bg-green-400' }}">
                        {{ $seat->seat_number }}
                    </div>
                </label>
                @endforeach
            </div>

            <div class="mt-6 text-center">
                <button type="submit"
                    class="bg-main text-white px-6 py-2 rounded-lg font-semibold hover:bg-main-dark">
                    Pesan Kursi
                </button>
            </div>
        </form>
    </div>
    <x-footer></x-footer>
</body>

</html>