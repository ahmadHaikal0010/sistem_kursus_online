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
            <div class="space-x-4">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Courses</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Register</a>
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
