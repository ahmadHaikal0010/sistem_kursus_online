@extends('layouts.app')

@section('title', 'Materi - ' . $course->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Materi: {{ $course->title }}</h1>

        @forelse ($course->materials as $material)
            <div class="mb-6 bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold">{{ $material->title }}</h2>
                <div class="text-gray-700 mt-2 whitespace-pre-line">{{ $material->content }}</div>
            </div>
        @empty
            <p class="text-gray-600">Belum ada materi untuk kursus ini.</p>
        @endforelse
    </div>
@endsection
