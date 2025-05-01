@extends('layouts.admin')

@section('content')
  <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Bioskop</h2>

    <form action="{{ route('bioskop.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      @csrf

      {{-- name Bioskop --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">name Bioskop</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Masukkan name bioskop"
          class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        />
      </div>

      {{-- address --}}
      <div>
        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">address</label>
        <input
          type="text"
          id="address"
          name="address"
          placeholder="Masukkan address lengkap"
          class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        />
      </div>

      {{-- contact --}}
      <div>
        <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">contact</label>
        <input
          type="text"
          id="contact"
          name="contact"
          placeholder="Masukkan contact"
          class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        />
      </div>

      {{-- Tombol Submit --}}
      <div class="sm:col-span-2">
        <button
          type="submit"
          class="inline-block rounded-sm border border-main bg-main px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-main transition-all">
          Simpan
        </button>
      </div>
    </form>
  </div>
@endsection
