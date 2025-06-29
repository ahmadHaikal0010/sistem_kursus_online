<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Kursus Online')</title>
    @vite('resources/css/app.css') {{-- Jika pakai Vite --}}
</head>

<body class="bg-gray-100 text-gray-900">

    {{-- Navbar --}}
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">KursusOnline</a>
            <div class="space-x-4 flex items-center"> {{-- Tambahkan 'flex items-center' di sini untuk keselarasan vertikal --}}
                @if (Auth::check())
                    @can('admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                        <a href="{{ route('admin.courses.index') }}" class="text-gray-700 hover:text-blue-600">Courses</a>
                    @endcan
                    @can('siswa')
                        <a href="{{ route('student.dashboard') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                        <a href="{{ route('student.courses') }}" class="text-gray-700 hover:text-blue-600">Courses</a>
                    @endcan
                @else
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                    <a href="{{ route('courses') }}" class="text-gray-700 hover:text-blue-600">Courses</a>
                @endif
                @auth
                    {{-- Tambahkan class 'inline-block' pada form --}}
                    <form method="post" action="/logout" class="inline-block">
                        @csrf
                        {{-- Sesuaikan styling button dengan Tailwind CSS --}}
                        <button type="submit" onclick="return confirm('Are you sure?')"
                            class="text-gray-700 hover:text-blue-600 focus:outline-none">Logout</button>
                    </form>
                @else
                    <a href="{{ route('loginForm') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                    <a href="{{ route('registerForm') }}" class="text-gray-700 hover:text-blue-600">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="min-h-screen pt-10">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t mt-10">
        <div class="container mx-auto px-4 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} KursusOnline. All rights reserved.
        </div>
    </footer>

</body>

</html>
