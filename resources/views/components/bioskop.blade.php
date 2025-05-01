<!-- resources/views/components/bioskop-filter.blade.php -->

<div class="flex items-center gap-4 bg-[#02003C] pt-5 rounded-lg mx-20">
    <!-- Tombol aktif -->
    <button class="text-white border-2 active:border-white rounded-full px-5 py-2 font-semibold">
        Semua Bioskop
    </button>

    <!-- Tombol tidak aktif -->
    <!-- Tombol aktif: jika tombol aktif -->
    <button class="text-white bg-main focus:outline-2 focus:outline-offset-2 focus:outline-main active:bg-white rounded-full px-5 py-2 font-semibold">
        XXI
    </button>
     <button class="text-gray-400 font-semibold hover:text-white transition">CGV</button>
    <button class="text-gray-400 font-semibold hover:text-white transition">Cinepolis</button>
</div>