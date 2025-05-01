@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Order Detail</h2>

    <form action="{{ route('orderdetail.update', $orderDetail->id) }}" method="POST" class="grid grid-cols-1 gap-6">
        @csrf
        @method('PUT')

        {{-- Order ID --}}
        <div>
            <label for="order_id" class="block text-sm font-medium text-gray-700 mb-1">Order ID</label>
            <select name="order_id" id="order_id" class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm" required>
                <option value="">-- Pilih Order --</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ $order->id == $orderDetail->order_id ? 'selected' : '' }}>{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        {{-- Seat ID --}}
        <div>
            <label for="seat_id" class="block text-sm font-medium text-gray-700 mb-1">Seat ID</label>
            <select name="seat_id" id="seat_id" class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm" required>
                <option value="">-- Pilih Seat --</option>
                @foreach($seats as $seat)
                    <option value="{{ $seat->id }}" {{ $seat->id == $orderDetail->seat_id ? 'selected' : '' }}>{{ $seat->id }}</option>
                @endforeach
            </select>
        </div>

        {{-- Is Available --}}
        <div>
            <label for="is_available" class="block text-sm font-medium text-gray-700 mb-1">Is Available</label>
            <select name="is_available" id="is_available" class="w-full rounded border border-gray-300 shadow-sm py-2 px-3 text-sm" required>
                <option value="1" {{ $orderDetail->is_available ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$orderDetail->is_available ? 'selected' : '' }}>No</option>
            </select>
        </div>

        {{-- Tombol Update --}}
        <div>
            <button type="submit" class="inline-block rounded-sm border border-indigo-600 bg-indigo-600 px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 transition-all">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
