<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Styles / Scripts -->
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-10 rounded shadow-md text-center">
            <h1 class="text-5xl font-bold text-red-500 mb-4">403</h1>
            <p class="text-xl text-gray-700">Waduh! Kamu tidak punya akses ke halaman ini.</p>
            <a href="{{ url('/') }}"
                class="mt-6 inline-block px-5 py-3 bg-green-500 text-white font-semibold rounded hover:bg-green-600 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>

</html>
