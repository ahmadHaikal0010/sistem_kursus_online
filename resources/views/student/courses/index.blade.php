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
                <div class="bg-white p-4 shadow rounded mb-4">
                    <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                    <p class="text-gray-600">{{ $course->description }}</p>

                    @if (!auth()->user()->courses->contains($course->id))
                        <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Gabung Kursus
                            </button>
                        </form>
                    @else
                        <p class="text-green-600 mt-2">Sudah tergabung</p>
                    @endif
                </div>
            @endforeach

        </div>
        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $courses->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
