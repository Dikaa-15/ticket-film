@extends('layouts.admin')

@section('content')

<h1 class="text-xl mb-3 text-gray-900 font-bold">Orders</h1>

<a
    class="inline-block rounded-sm border mb-5 items-end border-main bg-main px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-main focus:ring-3 focus:outline-hidden"
    href="{{ route('order.create') }}">
    Tambah Order
</a>

<div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50 text-left font-medium text-gray-700">
            <tr>
                <th class="px-4 py-3">Nomor Order</th>
                <th class="px-4 py-3">User</th>
                <th class="px-4 py-3">Showtime</th>
                <th class="px-4 py-3">Qty</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 bg-white">
            @foreach($orders as $order)
            <tr class="hover:bg-gray-50 transition-all">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $order->order_number }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $order->user->name ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $order->showtime->show_time ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $order->quantity }}</td>
                <td class="px-4 py-3 text-gray-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-gray-700"><span class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $order->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($order->status) }}
                    </span></td>
                <td class="px-4 py-3">
                    <span class="inline-flex divide-x divide-gray-300 overflow-hidden rounded border border-gray-300 bg-white shadow-sm">
                        <!-- Tombol Edit -->
                        <a href="{{ route('order.edit', $order->id) }}"
                            class="px-3 py-1.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:relative"
                            aria-label="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </a>

                        <!-- Tombol Delete -->
                        <form action="{{ route('order.destroy', $order->id) }}" method="POST"
                            onsubmit="return confirm('Yakin mau hapus genre ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900 focus:relative"
                                aria-label="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </span>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection