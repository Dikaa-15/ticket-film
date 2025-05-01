@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Film Bioskop</h2>

  <form action="{{ route('filmbioskop.update', $film->id) }}" method="POST" class="grid grid-cols-1 gap-6">
    @csrf
    @method('PUT')

    <div>
      <label for="film_id" class="block text-sm font-medium text-gray-700 mb-1">Judul Film</label>
      <input type="text" value="{{ $film->title }}" disabled class="w-full border rounded py-2 px-3 bg-gray-100 text-gray-600">
    </div>

    <div>
      <label for="bioskop_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bioskop</label>
      <select id="bioskop_id" name="bioskop_id" class="w-full border rounded py-2 px-3">
        @foreach($bioskops as $bioskop)
        <option value="{{ $bioskop->id }}" 
          {{ in_array($bioskop->id, $selectedBioskops) ? 'selected' : '' }}>
          {{ $bioskop->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div>
      <button type="submit" class="rounded-sm border border-main bg-main px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-main transition-all">
        Update
      </button>
    </div>
  </form>
</div>
@endsection
