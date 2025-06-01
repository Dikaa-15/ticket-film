@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Showtime</h2>

  <form action="{{ route('showtime.store') }}" method="POST" class="grid grid-cols-1 gap-6">
    @csrf

    {{-- Film --}}
    <div>
      <label for="film_id" class="block text-sm font-medium text-gray-700 mb-1">Film</label>
      <select
        id="film_id"
        name="film_id"
        class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required>
        @foreach($films as $film)
        <option value="{{ $film->id }}">{{ $film->title }}</option>
        @endforeach
      </select>
      @error('film_id')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Studio --}}
    <div>
      <label for="studio_id" class="block text-sm font-medium text-gray-700 mb-1">Studio</label>
      <select
        id="studio_id"
        name="studio_id"
        class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required>
        @foreach($studios as $studio)
        <option value="{{ $studio->id }}">{{ $studio->name }} - {{ $studio->bioskop->name }}</option>
        @endforeach
      </select>
      @error('studio_id')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Tanggal Showtime --}}
    <div>
      <label for="show_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Showtime</label>
      <input
        type="date"
        id="show_date"
        name="show_date"
        class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required />
        @error('show_date')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Jam Tayang --}}
    <div>
      <label for="show_time" class="block text-sm font-medium text-gray-700 mb-1">Jam Tayang</label>
      <input
        type="time"
        id="show_time"
        name="show_time"
        class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required />
        @error('show_time')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    {{-- Jam Akhir --}}
    <div>
      <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Jam Tayang</label>
      <input
        type="time"
        id="end_time"
        name="end_time"
        class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required />
        @error('end_time')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Harga --}}
    <div>
      <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
      <input
        type="number"
        id="price"
        name="price"
        class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required />
        @error('price')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tombol Simpan --}}
    <div>
      <button
        type="submit"
        class="inline-block rounded-sm border border-main bg-main px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-main transition-all">
        Simpan
      </button>
    </div>
  </form>
</div>
@endsection