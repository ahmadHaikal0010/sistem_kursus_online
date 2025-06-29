@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-5">
        <div class="text-center mb-4">
            <h1 class="text-3xl font-bold">Kursus Terbaru</h1>
            <p class="text-gray-600">Tingkatkan kemampuanmu dengan kursus berkualitas</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach ($courses as $course)
                <div class="bg-white rounded-xl shadow p-4 flex flex-col w-full">
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}"
                        class="rounded-lg mb-3 h-40 w-full object-cover">
                    <h2 class="text-xl font-semibold text-center">{{ $course->title }}</h2>
                    <span class="text-sm text-gray-500 block text-center">{{ $course->category->name }}</span>
                    <p class="mt-2 text-gray-700 text-center flex-grow">{{ Str::limit($course->description, 100) }}</p>
                    <a href="{{ route('courses.show', $course->id) }}"
                        class="inline-block mt-3 text-blue-500 hover:underline text-center">Lihat Detail</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
