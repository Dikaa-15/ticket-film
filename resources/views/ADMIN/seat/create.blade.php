@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Seat</h2>

  <form action="{{ route('seat.store') }}" method="POST" class="grid grid-cols-1 gap-6">
    @csrf

    <div>
      <label for="seat_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Seat</label>
      <input type="text" name="seat_number" required class="w-full rounded border-gray-300 px-3 py-2 text-sm" />
    </div>

    <div>
      <label for="studio_id" class="block text-sm font-medium text-gray-700 mb-1">Studio</label>
      <select name="studio_id" required class="w-full rounded border-gray-300 px-3 py-2 text-sm">
        @foreach($studios as $studio)
          <option value="{{ $studio->id }}">{{ $studio->name }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label for="bioskop_id" class="block text-sm font-medium text-gray-700 mb-1">Bioskop</label>
      <select name="bioskop_id" required class="w-full rounded border-gray-300 px-3 py-2 text-sm">
        @foreach($bioskops as $bioskop)
          <option value="{{ $bioskop->id }}">{{ $bioskop->name }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label for="is_available" class="block text-sm font-medium text-gray-700 mb-1">Ketersediaan</label>
      <select name="is_available" required class="w-full rounded border-gray-300 px-3 py-2 text-sm">
        <option value="1">Tersedia</option>
        <option value="0">Tidak Tersedia</option>
      </select>
    </div>

    <div>
      <button type="submit" class="rounded border border-main bg-main px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-main transition-all">
        Simpan
      </button>
    </div>
  </form>
</div>
@endsection
