<header class="">
    <div class="mx-auto max-w-screen-xl px-2 mt-[-5px] sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="md:flex md:items-center md:gap-12">
                <a class="block text-main" href="{{ route('home') }}">
                    <span class="sr-only">Home</span>
                    <img src="{{ asset('logos/logo-64-big.png') }}" alt="" href="{{ route('home') }}" class="w-10">
                </a>
            </div>

            <div class="hidden md:block">
                <nav aria-label="Global">
                    <ul class="flex items-center gap-6 text-sm">
                        <li>
                            <a class="text-white transition hover:text-gray-500/75" href="#"> Home </a>
                        </li>

                        <li>
                            <a class="text-white transition hover:text-gray-500/75" href="{{ route('user.film.index') }}"> Films </a>
                        </li>

                        <li>
                            <a class="text-white transition hover:text-gray-500/75" href="{{ route('contact.index') }}"> Contact us </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <div class="sm:flex sm:gap-4">
                    @auth
                    <div class="flex items-center gap-3">

                        <div class="text-sm text-white">
                            <h2>Halo, {{ auth()->user()->name }}</h2>
                        </div>

                        <div class="w-10 h-10">
                            <a
                                href="{{ auth()->user()->role === 'admin' ? route('admin') : route('dashboard') }}">
                                <img
                                    src="{{ Storage::url(auth()->user()->poto) }}"
                                    alt="Profile"
                                    class="rounded-full object-cover cursor-pointer w-10 h-10 border border-gray-300" />
                            </a>
                        </div>
                    </div>
                </div>

                @else
                <a
                    class="rounded-md bg-main px-5 py-2.5 text-sm font-medium text-white shadow-sm"
                    href="{{ route('login') }}">
                    Login
                </a>

                <div class="hidden sm:flex">
                    <a
                        class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-main"
                        href="{{ route('register') }}">
                        Register
                    </a>
                </div>
                @endauth

            </div>

            <div class="block md:hidden">
                <button
                    class="rounded-sm bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="size-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    </div>
</header>