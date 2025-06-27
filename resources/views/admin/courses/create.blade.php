@extends('layouts.app')

@section('title', 'Tambah Kursus')

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Tambah Kursus Baru</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Judul Kursus</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full mt-1 p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" required class="w-full mt-1 p-2 border border-gray-300 rounded">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4" required class="w-full mt-1 p-2 border border-gray-300 rounded">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Thumbnail (JPG/PNG)</label>
                <input type="file" name="thumbnail" accept="image/*"
                    class="w-full mt-1 p-2 border border-gray-300 rounded bg-white">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Kursus
            </button>
            <a href="{{ route('admin.courses.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
@endsection
