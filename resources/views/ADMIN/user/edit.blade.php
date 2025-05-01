@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit User</h2>

    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded px-3 py-2" placeholder="Nama Lengkap" required>
            @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded px-3 py-2" placeholder="Email" required>
            @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full border-gray-300 rounded px-3 py-2" placeholder="Password (Kosongkan jika tidak ingin mengganti)">
            @error('password') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block mb-1 text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role" class="w-full border-gray-300 rounded px-3 py-2" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- Phone --}}
        <div>
            <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="w-full border-gray-300 rounded px-3 py-2" placeholder="Nomor Telepon (Optional)">
        </div>

        {{-- Poto --}}
        <div>
            <label for="poto" class="block mb-1 text-sm font-medium text-gray-700">Foto (Optional)</label>
            <input type="file" name="poto" id="poto" class="w-full border-gray-300 rounded px-3 py-2">
            @error('poto') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
            @if($user->poto)
            <div class="mt-2">
                <img src="{{ asset('storage/'.$user->poto) }}" alt="Poto" class="w-24 h-24 object-cover rounded">
            </div>
            @endif
        </div>

        {{-- Tombol Simpan --}}
        <div>
            <button type="submit" class="inline-block rounded-sm border border-main bg-main px-8 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-main transition-all">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection