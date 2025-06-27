@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl mb-2">Statistik</h2>
            <p>Total Kursus: <strong>{{ $totalCourses }}</strong></p>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.courses.index') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Kelola Kursus
            </a>
        </div>
    </div>
@endsection
