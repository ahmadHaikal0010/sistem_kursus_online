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
                        @if (in_array($course->id, $enrolledCourseIds))
                            <button class="mt-4 bg-gray-300 text-gray-600 px-4 py-2 rounded cursor-not-allowed" disabled>
                                Sudah Terdaftar
                            </button>
                        @else
                            <form action="{{ route('student.enroll', $course->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Daftar Kursus
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                            Login untuk daftar
                        </a>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
@endsection
