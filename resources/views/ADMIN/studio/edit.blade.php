@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
  <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Studio</h2>

  <form action="{{ route('studio.update', $studio->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    @csrf
    @method('PUT')

    {{-- Nama Studio --}}
    <div>
      <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Studio</label>
      <input
        type="text"
        id="name"
        name="name"
        value="{{ old('name', $studio->name) }}"
        class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required
      />
    </div>

    {{-- Pilih Bioskop --}}
    <div>
      <label for="bioskop_id" class="block text-sm font-medium text-gray-700 mb-1">Bioskop</label>
      <select
        id="bioskop_id"
        name="bioskop_id"
        class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required
      >
        <option value="">Pilih Bioskop</option>
        @foreach($bioskops as $bioskop)
          <option value="{{ $bioskop->id }}" {{ $studio->bioskop_id == $bioskop->id ? 'selected' : '' }}>
            {{ $bioskop->name }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Tombol Update --}}
    <div class="sm:col-span-2">
      <button
        type="submit"
        class="inline-block rounded-sm border border-main bg-main px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-main transition-all"
      >
        Update
      </button>
    </div>
  </form>
</div>
@endsection
