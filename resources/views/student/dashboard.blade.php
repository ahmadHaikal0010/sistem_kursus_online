@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-5xl">
        <h1 class="text-2xl font-bold mb-6">Dashboard Siswa</h1>

        @forelse ($progressData as $data)
            <div class="mb-6 p-4 bg-white shadow rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $data['course']->title }}
                    </h2>
                    <a href="{{ route('student.materials.index', $data['course']->id) }}"
                        class="text-blue-600 text-sm hover:underline">Lihat Materi</a>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-4 mb-1">
                    <div class="bg-green-500 h-4 rounded-full" style="width: {{ $data['progress'] }}%;"></div>
                </div>
                <p class="text-sm text-gray-600">
                    {{ $data['completed'] }} dari {{ $data['total'] }} materi selesai ({{ $data['progress'] }}%)
                </p>
            </div>
        @empty
            <div class="text-gray-600">Anda belum mengikuti kursus apapun.</div>
        @endforelse
        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $courses->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
