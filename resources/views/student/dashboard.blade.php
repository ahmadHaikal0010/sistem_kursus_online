@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
    {{-- Kotak putih besar membungkus seluruh konten --}}
    <div class="bg-white shadow-lg rounded-lg mx-4 md:mx-auto mt-8 mb-8 p-6 max-w-7xl">
        <div class="container mx-auto px-4 py-10">
            <h1 class="text-2xl font-bold mb-6">Dashboard Siswa</h1>

            @forelse ($progressData as $data)
                <div class="mb-6 p-4 bg-gray-50 shadow-xl rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        {{-- Judul kursus yang bisa diklik --}}
                        <h2 class="text-xl font-semibold text-gray-800">
                            <a href="{{ route('student.materials.index', $data['course']->id) }}"
                                class="text-gray-800 hover:text-gray-600 hover:underline">
                                {{ $data['course']->title }}
                            </a>
                        </h2>
                        {{-- Tautan "Lihat Materi" dihilangkan --}}
                    </div>

                    {{-- <div class="w-full bg-gray-200 rounded-full h-4 mb-1">
                        <div class="bg-green-500 h-4 rounded-full" style="width: {{ $data['progress'] }}%;"></div>
                    </div> --}}
                    <p class="text-sm text-gray-600">
                        {{ $data['completed'] }} dari {{ $data['total'] }} materi selesai ({{ $data['progress'] }}%)
                    </p>
                </div>
            @empty
                <div class="text-gray-600">Anda belum mengikuti kursus apapun.</div>
            @endforelse
            <div class="mt-6">
                {{ $courses->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
@endsection
