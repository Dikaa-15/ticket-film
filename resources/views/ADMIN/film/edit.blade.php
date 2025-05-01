    @extends('layouts.admin')

    @section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Film</h2>

        <form action="{{ route('film.update', $film->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Film</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $film->title) }}"
                    placeholder="Masukkan judul film"
                    class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required />
                @error('title')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Genres Film</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($genres as $genre)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                                {{ in_array($genre->id, old('genre_ids', $filmGenreIds ?? [])) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">{{ $genre->name }}</span>
                        </label>
                        @endforeach

                    </div>
                    @error('genres_ids')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            {{-- Duration --}}
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                <input
                    type="time"
                    id="duration"
                    name="duration"
                    value="{{ old('duration', $film->duration) }}"
                    class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required />
                    @error('duration')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
            </div>

            {{-- Synopsis --}}
            <div class="sm:col-span-2">
                <label for="synopsis" class="block text-sm font-medium text-gray-700 mb-1">Sinopsis</label>
                <textarea
                    id="synopsis"
                    name="synopsis"
                    placeholder="Masukkan sinopsis film"
                    class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>{{ old('synopsis', $film->synopsis) }}</textarea>
                @error('synopsis')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Director --}}
            <div>
                <label for="director" class="block text-sm font-medium text-gray-700 mb-1">Sutradara</label>
                <input
                    type="director"
                    id="director"
                    name="director"
                    min="0"
                    max="59"
                    value="{{ old('director', $film->director) }}"
                    placeholder="Menit"
                    class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('director')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Release Date --}}
            <div>
                <label for="date_release" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Rilis</label>
                <input
                    type="date"
                    id="date_release"
                    name="date_release"
                    value="{{ old('date_release', $film->date_release->format('Y-m-d')) }}"
                    class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required />
                @error('date_release')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Poster --}}
            <div class="sm:col-span-2">
                <label for="poster" class="block text-sm font-medium text-gray-700 mb-1">Poster Film</label>
                <input
                    type="file"
                    id="poster"
                    name="poster"
                    class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @if($film->poster)
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-gray-700">Poster Saat Ini</label>
                    <img src="{{ asset('storage/' . $film->poster) }}" class="h-24 object-cover rounded">
                </div>
                @endif
                @error('poster')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

            </div>

            {{-- Trailer --}}
            <div class="sm:col-span-2">
                <label for="trailer" class="block text-sm font-medium text-gray-700 mb-1">Trailer</label>
                <input
                    type="url"
                    id="trailer"
                    name="trailer"
                    value="{{ old('trailer', $film->trailer) }}"
                    placeholder="Masukkan URL trailer"
                    class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                @error('trailer')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Submit --}}
            <div class="sm:col-span-2">
                <button
                    type="submit"
                    class="inline-block rounded-sm border border-main bg-main px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-main transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    @endsection