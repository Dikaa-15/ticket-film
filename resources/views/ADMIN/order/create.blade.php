@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Order</h2>

    <form action="{{ route('order.store') }}" method="POST" class="grid grid-cols-1 gap-6">
        @csrf

        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User</label>
            <select name="user_id" id="user_id" class="w-full border-gray-300 rounded shadow-sm">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>



        {{-- Showtime --}}
        <div>
            <label for="showtime_id" class="block text-sm font-medium text-gray-700 mb-1">Showtime</label>
            <select
                name="showtime_id"
                id="showtime_id"
                class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:ring-indigo-500"
                required>
                <option value="">-- Pilih Showtime --</option>
                @foreach($showtimes as $showtime)
                <option value="{{ $showtime->id }}">
                    {{ $showtime->film->title }} - {{ $showtime->studio->name }} - {{ $showtime->show_time }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Quantity --}}
        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tiket</label>
            <input type="number" name="quantity" id="quantity" class="w-full border rounded py-2 px-3 text-sm" required>
        </div>

        {{-- Total Price --}}
        <div>
            <label for="total_price" class="block text-sm font-medium text-gray-700 mb-1">Total Harga</label>
            <input type="number" name="total_price" id="total_price" class="w-full border rounded py-2 px-3 text-sm" required>
        </div>

        {{-- Payment Method --}}
        <div>
            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="e-wallet">E-Wallet</option>
                <option value="bca">BCA</option>
                <option value="manual">Manual Transfer</option>
            </select>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border-gray-300 rounded shadow-sm">
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="cancelled">Cancelled</option>
            </select>
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