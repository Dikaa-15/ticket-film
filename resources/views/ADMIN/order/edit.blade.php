@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Order</h2>

    <form action="{{ route('order.update', $order->id) }}" method="POST" class="grid grid-cols-1 gap-6">
        @csrf
        @method('PUT')

        {{-- User --}}
        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User</label>
            <select name="user_id" id="user_id" class="w-full border-gray-300 rounded shadow-sm">
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Showtime --}}
        <div>
            <label for="showtime_id" class="block text-sm font-medium text-gray-700 mb-1">Showtime</label>
            <select name="showtime_id" id="showtime_id"
                class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm focus:main"
                required>
                <option value="">-- Pilih Showtime --</option>
                @foreach($showtimes as $showtime)
                <option value="{{ $showtime->id }}" {{ $order->showtime_id == $showtime->id ? 'selected' : '' }}>
                    {{ $showtime->film->title }} - {{ $showtime->studio->name }} - {{ $showtime->show_time }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Quantity --}}
        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tiket</label>
            <input type="number" name="quantity" id="quantity" class="w-full border rounded py-2 px-3 text-sm" value="{{ $order->quantity }}" required>
        </div>

        {{-- Total Price --}}
        <div>
            <label for="total_price" class="block text-sm font-medium text-gray-700 mb-1">Total Harga</label>
            <input type="number" name="total_price" id="total_price" class="w-full border rounded py-2 px-3 text-sm" value="{{ $order->total_price }}" required>
        </div>

        {{-- Payment Method --}}
        <div>
            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method"
                class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="e-wallet" {{ $order->payment_method == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                <option value="bca" {{ $order->payment_method == 'bca' ? 'selected' : '' }}>BCA</option>
                <option value="manual" {{ $order->payment_method == 'manual' ? 'selected' : '' }}>Manual Transfer</option>
            </select>
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border-gray-300 rounded shadow-sm">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Paid</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        {{-- Tombol Update --}}
        <div>
            <button
                type="submit"
                class="inline-block rounded-sm border border-main bg-main px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-main transition-all">
                Update
            </button>
        </div>
    </form>
</div>
@endsection