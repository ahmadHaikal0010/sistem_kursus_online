@extends('layouts.app')

@section('title', 'Daftar Kursus')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6">Semua Kursus</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="mb-4 p-4 bg-yellow-100 text-yellow-700 rounded">
                {{ session('info') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($courses as $course)
                <div class="bg-white shadow rounded-xl p-4">
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}"
                        class="rounded-lg mb-3 h-40 w-full object-cover">
                    <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                    <p class="text-sm text-gray-500">{{ $course->category->name }}</p>
                    <p class="mt-2 text-gray-700">{{ Str::limit($course->description, 100) }}</p>

                    @auth
                    @else
                        <a href="{{ route('login') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                            Login untuk daftar
                        </a>
                    @endauth
                </div>
            @endforeach
        </div>
        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $courses->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
