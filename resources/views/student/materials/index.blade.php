@extends('layouts.app')

@section('title', 'Materi: ' . $course->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-4xl">
        <h1 class="text-2xl font-bold mb-6">Materi Kursus: {{ $course->title }}</h1>

        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Progress Belajar</h2>
            <div class="w-full bg-gray-200 rounded-full h-4 mb-1">
                <div class="bg-green-500 h-4 rounded-full" style="width: {{ $progress }}%;"></div>
            </div>
            <p class="text-sm text-gray-600">{{ $completed }} dari {{ $total }} materi selesai
                ({{ $progress }}%)</p>
        </div>


        <div class="bg-white shadow rounded-lg divide-y">
            @forelse ($materials as $material)
                <div class="p-4 hover:bg-gray-50 flex justify-between">
                    <div>
                        @if (auth()->user()->readMaterials->contains($material->id))
                            <span class="text-green-600">✔</span>
                        @endif
                        <a href="{{ route('student.materials.show', [$course->id, $material->id]) }}"
                            class="text-lg font-semibold text-blue-600 hover:underline">
                            {{ $material->title }}
                        </a>
                        <p class="text-gray-600 text-sm">Tipe: {{ ucfirst($material->type) }}</p>
                    </div>
                </div>
            @empty
                <div class="p-4 text-gray-600">Belum ada materi tersedia.</div>
            @endforelse
        </div>

        <div class="mt-6">
            <a href="{{ route('student.dashboard', $course->id) }}" class="text-blue-600 hover:underline">
                &larr; Kembali ke Dashboard
            </a>
        </div>

        <div class="mt-6">
            {{ $materials->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
