@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6">Selamat datang, {{ Auth::user()->name }}!</h1>

        <h2 class="text-xl font-semibold mb-4">Kursus yang Kamu Ikuti</h2>

        @if ($courses->isEmpty())
            <p class="text-gray-600">Kamu belum mendaftar kursus apa pun.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($courses as $enrollment)
                    <div class="bg-white rounded-xl shadow p-4">
                        <h3 class="text-lg font-semibold">{{ $enrollment->course->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $enrollment->course->category->name }}</p>
                        <p class="mt-2 text-gray-700">{{ Str::limit($enrollment->course->description, 100) }}</p>
                        <a href="{{ route('student.materials.index', $enrollment->course->id) }}"
                            class="text-blue-600 hover:underline mt-3 inline-block">Lihat Materi</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
