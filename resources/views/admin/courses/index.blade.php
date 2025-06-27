@extends('layouts.app')

@section('title', 'Kelola Kursus')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Kursus</h1>
            <a href="{{ route('admin.courses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Kursus
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800 divide-y">
                    @foreach ($courses as $course)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $course->title }}</td>
                            <td class="px-4 py-3">{{ $course->category->name }}</td>
                            <td class="px-4 py-3">{{ Str::limit($course->description, 60) }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('admin.courses.edit', $course->id) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                                <a href="{{ route('admin.courses.materials.index', $course->id) }}"
                                    class="text-indigo-600 hover:underline">Materi</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $courses->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
