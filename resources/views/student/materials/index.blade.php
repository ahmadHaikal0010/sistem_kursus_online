@extends('layouts.app')

@section('title', 'Materi: ' . $course->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-4xl">
        <h1 class="text-2xl font-bold mb-6">Materi Kursus: {{ $course->title }}</h1>

        <div class="bg-white shadow rounded-lg divide-y">
            @forelse ($materials as $material)
                <div class="p-4 hover:bg-gray-50 flex justify-between">
                    <div>
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
            {{ $materials->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
