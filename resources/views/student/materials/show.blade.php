@extends('layouts.app')

@section('title', $material->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-3xl">
        <h1 class="text-2xl font-bold mb-2">{{ $material->title }}</h1>
        <p class="text-sm text-gray-600 mb-4">Kursus: {{ $course->title }} | Tipe: {{ ucfirst($material->type) }}</p>

        @if ($material->type === 'text')
            <div class="prose max-w-none">
                {!! nl2br(e($material->content)) !!}
            </div>
        @elseif ($material->type === 'video' && $material->video_path)
            <div class="mb-6">
                <video controls class="w-full rounded shadow">
                    <source src="{{ asset('storage/' . $material->video_path) }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            </div>
        @elseif ($material->type === 'link' && $material->video_link)
            <div class="aspect-w-16 aspect-h-9">
                <iframe class="w-full h-96 rounded shadow"
                    src="{{ Str::contains($material->video_link, 'youtube.com') || Str::contains($material->video_link, 'youtu.be') ? 'https://www.youtube.com/embed/' . Str::afterLast($material->video_link, '/') : $material->video_link }}"
                    frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('student.materials.index', $course->id) }}" class="text-blue-600 hover:underline">
                &larr; Kembali ke Daftar Materi
            </a>
        </div>
        <div class="mt-10 flex justify-between items-center">
            @if ($previous)
                <a href="{{ route('student.materials.show', [$course->id, $previous->id]) }}"
                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                    &larr; {{ Str::limit($previous->title, 20) }}
                </a>
            @else
                <div></div>
            @endif

            @if ($next)
                <a href="{{ route('student.materials.show', [$course->id, $next->id]) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ Str::limit($next->title, 20) }} &rarr;
                </a>
            @endif
        </div>

    </div>
@endsection
