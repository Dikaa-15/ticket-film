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

<body class="bg-main">
    <div class="max-w-6xl mx-auto py-10">
        <h2 class="text-2xl font-bold text-white text-center mb-6">
            Pilih Kursi untuk {{ $showtime->film->title }}
        </h2>

        {{-- LAYAR --}}
        <div class="mb-10">
            <div class="w-full bg-gray-300 text-center py-2 rounded-t-xl text-gray-700 font-semibold tracking-widest shadow-inner">
                LAYAR
            </div>
            <div class="h-2 bg-gradient-to-t from-gray-300 to-transparent rounded-b-lg"></div>
        </div>

        <form method="POST" action="{{ route('seat.confirm', $showtime->id) }}">
            @csrf

            <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4 justify-center">
                @foreach($seats as $seat)
                @php
                $isBooked = in_array($seat->id, $bookedSeatIds);
                $isAvailable = $seat->is_available;
                @endphp

                <label class="cursor-pointer relative group"
                    title="{{ $isBooked ? 'Seat already booked' : ($isAvailable ? 'Available seat' : 'Seat unavailable') }}">
                    <input
                        type="checkbox"
                        name="seats[]"
                        value="{{ $seat->id }}"
                        class="hidden seat-checkbox"
                        {{ !$isAvailable || $isBooked ? 'disabled' : '' }}>

                    <div class="seat-box p-4 py-6 rounded-lg text-center transition duration-300Add commentMore actions
                {{ $isBooked 
                    ? 'bg-white text-main cursor-not-allowed' 
                    : ($isAvailable 
                        ? 'border-2 border-white text-white hover:bg-white hover:text-black group-hover:scale-105' 
                        : 'bg-gray-400 text-gray-700 cursor-not-allowed') }}">

                        {{-- Nomor Kursi --}}
                        <span class="block font-bold">
                            {{ $seat->seat_number }}
                        </span>
                    </div>
                </label>
                @endforeach

            </div>


            <div class="mt-8 text-center">
                <button type="submit"
                    class="bg-white text-main px-6 py-2 rounded-lg font-semibold hover:bg-main-dark transition">
                    Select Seats
                </button>
            </div>
        </form>

        {{-- LEGEND --}}
        <div class="flex justify-center gap-6 mt-10 text-sm text-gray-300">
            <div class="flex items-center gap-2">
                <span class="inline-block w-5 h-5 bg-transparent border-2 border-white rounded-sm"></span> Available
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-block w-5 h-5 bg-white rounded-sm"></span> Booked
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-block w-5 h-5 bg-amber-500 border-2 border-black rounded-sm"></span> Selected
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.querySelectorAll('.seat-checkbox').forEach((checkbox) => {
            const box = checkbox.nextElementSibling;

            // Saat halaman load, pastikan style sesuai kondisi
            if (checkbox.checked) {
                box.classList.add('bg-white', 'text-black', 'border-black');
                box.classList.remove('text-white', 'hover:bg-white', 'hover:text-black');
            }

            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    box.classList.add('bg-amber-500', 'text-white', 'border-black');
                    box.classList.remove('text-white', 'hover:bg-white', 'hover:text-black');
                } else {
                    box.classList.remove('bg-amber-500', 'text-black', 'border-black');
                    box.classList.add('text-white', 'hover:bg-white', 'hover:text-black');
                }
            });
        });
    </script>


    <x-footer></x-footer>
</body>

</html>