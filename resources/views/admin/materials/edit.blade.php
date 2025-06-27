@extends('layouts.app')

@section('title', 'Edit Materi - ' . $material->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Edit Materi: {{ $material->title }}</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.courses.materials.update', [$course->id, $material->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Judul Materi</label>
                <input type="text" name="title" value="{{ old('title', $material->title) }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tipe Konten</label>
                <div class="mt-2 space-y-2">
                    @foreach (['text' => 'Teks', 'video' => 'Upload Video', 'link' => 'Link Video'] as $value => $label)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="type" value="{{ $value }}"
                                {{ old('type', $material->type) === $value ? 'checked' : '' }} onchange="toggleFields()" />
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div id="text-field" class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Konten Teks</label>
                <textarea name="content" rows="5" class="w-full mt-1 p-2 border border-gray-300 rounded">{{ old('content', $material->content) }}</textarea>
            </div>

            <div id="video-field" class="mb-4 hidden">
                @if ($material->video_path)
                    <p class="text-sm text-gray-600 mb-2">Video Saat Ini:</p>
                    <video src="{{ asset('storage/' . $material->video_path) }}" controls
                        class="mb-2 w-full rounded shadow"></video>
                @endif
                <label class="block text-sm font-medium text-gray-700">Upload Video Baru (Opsional)</label>
                <input type="file" name="video_file" accept="video/mp4"
                    class="w-full mt-1 p-2 border border-gray-300 rounded bg-white">
            </div>

            <div id="link-field" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700">Link Video</label>
                <input type="url" name="video_link" value="{{ old('video_link', $material->video_link) }}"
                    placeholder="https://youtube.com/..." class="w-full mt-1 p-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.courses.materials.index', $course->id) }}"
                class="ml-3 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>

    <script>
        function toggleFields() {
            const type = document.querySelector('input[name="type"]:checked').value;
            document.getElementById('text-field').classList.add('hidden');
            document.getElementById('video-field').classList.add('hidden');
            document.getElementById('link-field').classList.add('hidden');

            if (type === 'text') {
                document.getElementById('text-field').classList.remove('hidden');
            } else if (type === 'video') {
                document.getElementById('video-field').classList.remove('hidden');
            } else if (type === 'link') {
                document.getElementById('link-field').classList.remove('hidden');
            }
        }

        window.onload = toggleFields;
    </script>
@endsection
