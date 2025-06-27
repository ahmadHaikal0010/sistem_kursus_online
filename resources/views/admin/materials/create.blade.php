@extends('layouts.app')

@section('title', 'Tambah Materi - ' . $course->title)

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-2xl">
        <h1 class="text-2xl font-bold mb-6">Tambah Materi untuk: {{ $course->title }}</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.courses.materials.store', $course->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Judul Materi</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Radio Pilihan Tipe Konten -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tipe Konten</label>
                <div class="mt-2 space-y-2">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="type" value="text" class="text-blue-600" checked
                            onchange="toggleFields()" />
                        <span>Teks</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="type" value="video" class="text-blue-600"
                            onchange="toggleFields()" />
                        <span>Upload Video</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="type" value="link" class="text-blue-600"
                            onchange="toggleFields()" />
                        <span>Link Video (YouTube)</span>
                    </label>
                </div>
            </div>

            <!-- Konten Teks -->
            <div id="text-field" class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Konten Materi (Teks)</label>
                <textarea name="content" rows="5" class="w-full mt-1 p-2 border border-gray-300 rounded">{{ old('content') }}</textarea>
            </div>

            <!-- Upload Video -->
            <div id="video-field" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700">Upload Video (.mp4)</label>
                <input type="file" name="video_file" accept="video/mp4"
                    class="w-full mt-1 p-2 border border-gray-300 rounded bg-white">
            </div>

            <!-- Link YouTube -->
            <div id="link-field" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700">Link Video (YouTube)</label>
                <input type="url" name="video_link" placeholder="https://youtube.com/..."
                    class="w-full mt-1 p-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Materi
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

        // Inisialisasi saat halaman dimuat
        window.onload = toggleFields;
    </script>
@endsection
