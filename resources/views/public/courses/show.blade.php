@extends('layouts.app')

@section('title', $course->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-3xl">
        <h1 class="text-3xl font-bold mb-2">{{ $course->title }}</h1>
        <p class="text-gray-500 mb-4">{{ $course->category->name }}</p>
        <p class="text-gray-700 leading-relaxed mb-6">{{ $course->description }}</p>

        @auth
            @if ($enrolled)
                <a href="{{ route('student.courses.materials', $course->id) }}"
                    class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
                    Lihat Materi Kursus
                </a>
            @else
                <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                        Daftar Kursus
                    </button>
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login untuk daftar</a>
        @endauth
    </div>
@endsection
