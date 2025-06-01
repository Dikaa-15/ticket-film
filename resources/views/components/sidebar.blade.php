<div class="flex h-screen flex-col justify-between border-e border-gray-100 bg-white">
  <div class="px-4 py-6">
    <span class="grid h-10 w-32 place-content-center rounded-lg  text-gray-600">
      <a href="{{ route('home') }}">
        <img src="{{ asset('logos/logo-64-big.png') }}" alt="" class="h-10 w-10" />
      </a>
    </span>

    <ul class="mt-6 space-y-1">
      <li>
        <a
          href="{{ route('admin') }}"
          class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('admin') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
          Dashboard
        </a>
      </li>

      <li>
        <details class="group [&_summary::-webkit-details-marker]:hidden">
          <summary
            class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
            <span class="text-sm font-medium"> Films </span>

            <span class="shrink-0 transition duration-300 group-open:-rotate-180">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-5"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </span>
          </summary>

          <ul class="mt-2 space-y-1 px-4">
            <li>
              <a
                href="{{ route('bioskop.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('bioskop.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                Bioskop
              </a>

            </li>

            <li>
              <a
                href="{{ route('film.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('film.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                Film
              </a>

            </li>

            <li>
              <a
                href="{{ route('studio.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('studio.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                Studio
              </a>

            </li>
            
          </ul>
        </details>
      </li>
      <li>
        <details class="group [&_summary::-webkit-details-marker]:hidden">
          <summary
            class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
            <span class="text-sm font-medium"> Others </span>

            <span class="shrink-0 transition duration-300 group-open:-rotate-180">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-5"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </span>
          </summary>

          <ul class="mt-2 space-y-1 px-4">
            <li>
              <a
                href="{{ route('genre.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('genre.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                Genre
              </a>

            </li>

            <li>
              <a
                href="{{ route('user.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('user.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                User
              </a>

            </li>
          </ul>
        </details>
      </li>
      <li>
        <details class="group [&_summary::-webkit-details-marker]:hidden">
          <summary
            class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
            <span class="text-sm font-medium"> Managements </span>

            <span class="shrink-0 transition duration-300 group-open:-rotate-180">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-5"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </span>
          </summary>

          <ul class="mt-2 space-y-1 px-4">
            <li>
              <a
                href="{{ route('orderdetail.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('orderdetail.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                Order Detail
              </a>

            </li>
            <li>
              <a
                href="{{ route('order.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('order.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                Order
              </a>

            </li>
            <li>
              <a
                href="{{ route('seat.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('seat.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                Seat
              </a>

            </li>

            <li>
              <a
                href="{{ route('showtime.index') }}"
                class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('showtime.index') ? 'bg-main text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                Showtime
              </a>

            </li>
          </ul>
        </details>
      </li>
      <li class="pt-4 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            type="submit"
            class="w-full text-left rounded-lg px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-800">
            Logout
          </button>
        </form>
      </li>

    </ul>
  </div>

  @auth
  <div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
    <a href="#" class="flex items-center gap-2 bg-white p-4 hover:bg-gray-50">
      <img
        src="{{ Storage::url(auth()->user()->poto) }}"
        alt="Profile"
        class="size-10 rounded-full object-cover" />

      <div>
        <p class="text-xs">
          <strong class="block font-medium">Hi, {{ auth()->user()->name }}</strong>

          <span> {{ auth()->user()->email }} </span>
        </p>
      </div>
    </a>
  </div>
  @endauth

</div>