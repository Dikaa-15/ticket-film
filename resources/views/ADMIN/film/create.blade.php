@extends('layouts.admin')

@section('content')

<h1 class="text-xl mb-5 font-bold text-gray-900">Tambah Film</h1>

<form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
    @csrf

    <div class="grid grid-cols-2 gap-4 mb-4 focus:ring-main">
        <div>
            <label class="block mb-1 text-sm text-gray-700">Judul Film</label>
            <input type="text" name="title" class="w-full rounded border-gray-300 shadow-sm sm:text-sm" value="{{ old('title') }}">
            @error('title')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-700">Genre Film</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($genres as $genre)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                        {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700">{{ $genre->name }}</span>
                </label>
                @endforeach
            </div>
            @error('genre_ids')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>



        <!-- <div class="mb-4">
            <label for="hours" class="block text-sm font-medium text-gray-700">Durasi</label>
            <div class="flex space-x-2">
                <input type="number" name="hours" id="hours" min="0" value="{{ old('hours') }}" class="w-1/2 rounded border-gray-300" placeholder="Jam">
                <input type="number" name="minutes" id="minutes" min="0" max="59" value="{{ old('minutes') }}" class="w-1/2 rounded border-gray-300" placeholder="Menit">
            </div>
            @error('duration')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div> -->

        {{-- Duration --}}
        <div>
            <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
            <input
                type="time"
                id="duration"
                name="duration"
                class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-main"
                required />
            @error('duration')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>



        <div>
            <label class="block mb-1 text-sm text-gray-700">Sutradara</label>
            <input type="text" name="director" class="w-full rounded border-gray-300 shadow-sm sm:text-sm" value="{{ old('director') }}">
            @error('director')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm text-gray-700">Tanggal Rilis</label>
            <input type="date" name="date_release" class="w-full rounded border-gray-300 shadow-sm sm:text-sm" value="{{ old('date_release') }}">
            @error('date_release')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label class="block mb-1 text-sm text-gray-700">Sinopsis</label>
        <textarea name="synopsis" rows="4" class="w-full rounded border-gray-300 shadow-sm sm:text-sm">{{ old('synopsis') }}</textarea>
        @error('synopsis')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 text-sm text-gray-700">Upload Poster</label>
        <input type="file" name="poster" accept="image/*" class="w-full rounded border-gray-300 shadow-sm sm:text-sm">
        @error('poster')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 text-sm text-gray-700">Link Trailer (Opsional)</label>
        <input type="url" name="trailer" class="w-full rounded border-gray-300 shadow-sm sm:text-sm" value="{{ old('trailer') }}">
        @error('trailer')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        class="inline-block rounded-sm border border-main bg-main px-6 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600">
        Simpan
    </button>
</form>

@endsection