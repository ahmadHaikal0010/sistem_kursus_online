@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white shadow-md rounded-xl">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>

            {{-- Bagian ini diperbaiki untuk menampilkan semua error, atau error spesifik --}}
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-md bg-red-100 border border-red-400 text-red-700 text-sm">
                    {{-- Loop untuk menampilkan semua pesan error, ini lebih baik daripada hanya first() --}}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror">
                    {{-- Tampilan error spesifik untuk field email --}}
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 @error('password') border-red-500 @enderror">
                    {{-- Tampilan error spesifik untuk field password (jika ada) --}}
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="mr-2">
                        Ingat saya
                    </label>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700">
                    Login
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-6">
                Belum punya akun?
                <a href="{{ route('registerForm') }}" class="text-blue-600 hover:underline">Daftar</a>
            </p>
        </div>
    </div>
@endsection
