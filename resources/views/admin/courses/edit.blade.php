@extends('layouts.app')

@section('title', 'Edit Kursus')

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Edit Kursus</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Judul Kursus</label>
                <input type="text" name="title" value="{{ old('title', $course->title) }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" class="w-full mt-1 p-2 border border-gray-300 rounded">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full mt-1 p-2 border border-gray-300 rounded">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Thumbnail Baru (jika ingin mengganti)</label>
                <input type="file" name="thumbnail" accept="image/*"
                    class="w-full mt-1 p-2 border border-gray-300 rounded bg-white">
            </div>

            @if ($course->thumbnail)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Thumbnail Saat Ini</label>
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" class="h-24 mt-2 rounded shadow">
                </div>
            @endif

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Kursus
            </button>
            <a href="{{ route('admin.courses.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
@endsection
