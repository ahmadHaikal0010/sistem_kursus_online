@extends('layouts.app')

@section('title', 'Materi: ' . $course->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-5xl">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Materi Kursus</h1>
            <p class="text-xl text-blue-600 mt-1">{{ $course->title }}</p>
        </div>

        {{-- Progress Section --}}
        <div class="mb-8 p-6 bg-white shadow-xl rounded-2xl border border-blue-100">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-semibold text-gray-700">Progress Belajar</h2>
                <span class="text-sm text-gray-500">{{ $completed }} dari {{ $total }} materi
                    ({{ $progress }}%)</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                <div class="bg-gradient-to-r from-green-400 to-green-600 h-full transition-all duration-500"
                    style="width: {{ $progress }}%;"></div>
            </div>
        </div>

        {{-- Materials List --}}
        <div class="space-y-4">
            @forelse ($materials as $material)
                <div
                    class="flex items-center justify-between p-5 bg-white rounded-2xl shadow-md border border-gray-100 transition-all hover:shadow-lg group">
                    <div>
                        <a href="{{ route('student.materials.show', [$course->id, $material->id]) }}"
                            class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">
                            {{ $material->title }}
                        </a>
                        <p class="text-sm text-gray-500 mt-1">Tipe: <span class="capitalize">{{ $material->type }}</span>
                        </p>
                    </div>
                    @if (auth()->user()->readMaterials->contains($material->id))
                        <div class="text-green-600 text-xl font-bold bg-green-100 rounded-full px-3 py-1 shadow-sm">✔</div>
                    @endif
                </div>
            @empty
                <div class="p-6 bg-white text-center text-gray-600 rounded-2xl shadow-md border border-gray-100">
                    Belum ada materi tersedia.
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $materials->links('vendor.pagination.tailwind') }}
        </div>

        {{-- Back Button --}}
        <div class="mt-10 text-center">
            <a href="{{ route('student.dashboard') }}"
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition duration-300">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection
