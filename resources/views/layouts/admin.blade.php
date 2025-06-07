<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Bioskop App')</title>
  @vite('resources/css/app.css') {{-- Tailwind via Vite --}}

  <!-- Tambahkan Select2 CSS dan JS di dalam bagian head -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/selxect2@4.0.13/dist/js/select2.min.js"></script> -->

</head>

<body class="bg-white-100 text-gray-900">

  <div class="flex h-screen">

    <!-- Navbar / Header -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto mt2">
      @yield('content')
    </main>
    <!--  -->

  </div>

  

</body>

</html>