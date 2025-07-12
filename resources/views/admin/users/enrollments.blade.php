@extends('layouts.app')

@section('title', 'Daftar Enrollments Pengguna')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Daftar Pengguna & Kursus yang Diikuti</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Container utama tabel dengan rounded-xl dan shadow --}}
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            {{-- Tabel dengan lebar minimum penuh dan layout otomatis --}}
            <table class="min-w-full table-auto">
                {{-- Header tabel dengan latar belakang abu-abu muda, teks rata kiri, ukuran kecil, tebal, dan warna abu-abu gelap --}}
                <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        {{-- Sel header dengan padding yang diperbarui --}}
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Kursus Diikuti</th>
                    </tr>
                </thead>
                {{-- Body tabel dengan ukuran teks kecil, warna teks abu-abu gelap, dan pemisah baris --}}
                <tbody class="text-sm text-gray-800 divide-y">
                    @forelse ($users as $user)
                        <tr>
                            {{-- Sel data dengan padding yang diperbarui --}}
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium">{{ $user->name }}</td> {{-- Menggunakan font-medium untuk nama --}}
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                @if ($user->courses->isEmpty())
                                    <span class="text-gray-500 italic">Belum mengikuti kursus</span>
                                @else
                                    <ul class="list-disc pl-5">
                                        @foreach ($user->courses as $course)
                                            <li class="flex justify-between">
                                                <span>{{ $course->title }}
                                                    ({{ $course->pivot->created_at->format('d M Y') }})
                                                </span>
                                                <form method="POST"
                                                    action="{{ route('admin.users.enrollments.unenroll', [$user->id, $course->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 text-xs hover:underline"
                                                        onclick="return confirm('Yakin hapus enroll ini?')">Hapus</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- Pesan jika tidak ada pengguna ditemukan, dengan padding yang diperbarui --}}
                            <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada pengguna ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
