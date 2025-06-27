@extends('layouts.app')

@section('title', 'Materi - ' . $course->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-5xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Materi: {{ $course->title }}</h1>
            <a href="{{ route('admin.courses.materials.create', $course->id) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Materi
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow divide-y">
            @forelse ($materials as $material)
                <div class="p-4 hover:bg-gray-50">
                    <a href="{{ route('admin.courses.materials.show', [$course->id, $material->id]) }}"
                        class="text-lg font-semibold text-blue-700 hover:underline">
                        {{ $material->title }}
                    </a>
                    <p class="text-gray-600 text-sm mt-1">Tipe: {{ ucfirst($material->type) }}</p>
                </div>
            @empty
                <div class="p-4 text-gray-600">Belum ada materi untuk kursus ini.</div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $materials->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
