@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded shadow border-l-4 border-blue-500">
                <h3 class="text-gray-600 text-sm mb-1">Total Kursus</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $totalCourses }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow border-l-4 border-green-500">
                <h3 class="text-gray-600 text-sm mb-1">Total Pengguna</h3>
                <p class="text-2xl font-bold text-green-600">{{ $totalUsers }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow border-l-4 border-yellow-500">
                <h3 class="text-gray-600 text-sm mb-1">Total Enroll</h3>
                <p class="text-2xl font-bold text-yellow-600">{{ $totalEnrollments }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow border-l-4 border-purple-500">
                <h3 class="text-gray-600 text-sm mb-1">Total Materi</h3>
                <p class="text-2xl font-bold text-purple-600">{{ $totalMaterials }}</p>
            </div>
        </div>

        {{-- Perubahan ada di bagian ini --}}
        {{-- <div class="flex flex-col md:flex-row justify-center gap-4 mb-10">
            <a href="{{ route('admin.courses.index') }}"
                class="bg-blue-600 text-white text-center py-3 rounded hover:bg-blue-700 font-semibold w-full md:w-auto px-6">
                Kelola Kursus
            </a>
            <a href="{{ route('admin.users.enrollments') }}"
                class="bg-green-600 text-white text-center py-3 rounded hover:bg-green-700 font-semibold w-full md:w-auto px-6">
                Lihat Enrollments
            </a>
        </div> --}}

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Grafik Statistik</h2>
            <canvas id="enrollmentChart" height="100"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('enrollmentChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Enroll per Bulan',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
