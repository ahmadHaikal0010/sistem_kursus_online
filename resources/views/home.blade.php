@extends('layouts.app')

@section('title', 'Belajar Lebih Mudah - Kursus Online')

@section('content')
    <div class="bg-white">

        {{-- Hero Section --}}
        <section class="relative bg-blue-600 text-white py-20 px-4 text-center">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Belajar Lebih Mudah & Efektif</h1>
                <p class="text-lg md:text-xl mb-8">Akses kursus berkualitas tinggi kapan saja, di mana saja.</p>
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-600 font-semibold px-6 py-3 rounded shadow hover:bg-gray-100 transition">
                    Mulai Belajar Sekarang
                </a>
            </div>
        </section>

        {{-- Fitur Section --}}
        <section class="py-16 px-4 bg-gray-50">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-12">Kenapa Pilih Platform Kami?</h2>
                <div class="grid md:grid-cols-3 gap-10">
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                        <h3 class="text-xl font-semibold mb-3">Akses Materi Interaktif</h3>
                        <p class="text-gray-600">Teks, video, dan link pembelajaran terstruktur.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                        <h3 class="text-xl font-semibold mb-3">Lacak Progress</h3>
                        <p class="text-gray-600">Pantau kemajuan belajarmu dengan progress tracker real-time.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                        <h3 class="text-xl font-semibold mb-3">Dashboard Siswa & Admin</h3>
                        <p class="text-gray-600">Kontrol penuh bagi siswa maupun pengelola kursus.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Kursus Terbaru --}}
        <section class="py-16 px-4 bg-white">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-12">Kursus Terbaru</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach ($latestCourses as $course)
                        <div class="bg-gray-50 p-5 rounded shadow hover:shadow-md transition text-left">
                            <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 80) }}</p>
                            <a href="{{ route('courses.show', $course->id) }}"
                                class="text-blue-600 font-semibold hover:underline">Lihat Kursus</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="bg-blue-600 text-white py-16 px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Gabung Sekarang dan Mulai Belajar!</h2>
            <a href="{{ route('register') }}"
                class="bg-white text-blue-600 px-6 py-3 rounded font-semibold hover:bg-gray-100 transition">
                Daftar Gratis
            </a>
        </section>

    </div>
@endsection
