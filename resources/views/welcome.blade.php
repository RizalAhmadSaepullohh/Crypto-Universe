<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crypto Universe</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Style untuk animasi fade-in bisa tetap di sini, tidak masalah --}}
    <style>
        .fade-in-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .fade-in-section.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="antialiased bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300">

    {{-- Navigasi --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <a href="/" class="flex items-center">
                    <img src="{{ asset('channels4_profile.jpg') }}" alt="Crypto Universe" class="h-10 w-auto">
                </a>

                {{-- Tombol Login/Register --}}
                <div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ms-4 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{-- Hero Section --}}
        <section class="relative h-screen flex items-center justify-center">
            {{-- Background Image --}}
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?crypto,network');"></div>
            {{-- Overlay Gelap --}}
            <div class="absolute inset-0 bg-black opacity-60"></div>
            {{-- Konten Teks --}}
            <div class="relative z-10 text-center px-4">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight">
                    Selamat Datang di Crypto Universe
                </h1>
                <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-300">
                    Dasbor personal Anda untuk melacak transaksi aset kripto di Indonesia dengan mudah dan aman.
                </p>
            </div>
        </section>

        {{-- Features Section --}}
        <section id="features" class="py-20 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Fitur Unggulan</h2>
                </div>
                <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-3">
                    {{-- Feature 1 --}}
                    <div class="fade-in-section p-6 bg-white dark:bg-gray-700/50 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">Manajemen Transaksi</h3>
                        <p class="mt-2 text-base">Catat semua transaksi beli dan jual aset kripto Anda dengan mudah melalui fitur CRUD yang lengkap.</p>
                    </div>
                    {{-- Feature 2 --}}
                    <div class="fade-in-section p-6 bg-white dark:bg-gray-700/50 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">Lacak Aktivitas</h3>
                        <p class="mt-2 text-base">Pantau riwayat login dan jejak audit perubahan data transaksi untuk keamanan dan transparansi.</p>
                    </div>
                    {{-- Feature 3 --}}
                    <div class="fade-in-section p-6 bg-white dark:bg-gray-700/50 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">Dashboard Intuitif</h3>
                        <p class="mt-2 text-base">Lihat ringkasan dan riwayat transaksi terbaru Anda dalam satu halaman dashboard yang informatif.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Call to Action Section --}}
        <section class="py-20 bg-white dark:bg-gray-900">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 fade-in-section">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Siap Memulai?</h2>
                <p class="mt-4 text-lg leading-6 text-gray-600 dark:text-gray-400">Buat akun gratis Anda sekarang dan mulai lacak portofolio kripto Anda.</p>
                <a href="{{ route('register') }}" class="mt-8 inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Daftar Sekarang
                </a>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 dark:bg-black">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-400">Copyright &copy; {{ date('Y') }} Crypto Universe. All Rights Reserved.</p>
        </div>
    </footer>

    {{-- Script untuk animasi fade-in bisa tetap di sini --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.fade-in-section');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</body>
</html>