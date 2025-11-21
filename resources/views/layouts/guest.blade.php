<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800">
            
            <!-- Decorative Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/5 rounded-full"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white/5 rounded-full"></div>
                <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white/5 rounded-full"></div>
            </div>

            <!-- Logo Section -->
            <div class="relative z-10 mb-6">
                <a href="/" class="flex flex-col items-center group">
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-xl flex items-center justify-center mb-4 group-hover:shadow-2xl transform group-hover:-translate-y-1 transition duration-300">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white">RuangRapat</h1>
                    <p class="text-blue-200 text-sm mt-1">Sistem Reservasi Ruang Rapat</p>
                </a>
            </div>

            <!-- Card Container -->
            <div class="relative z-10 w-full sm:max-w-md mt-2 px-6 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl">
                <!-- Card Top Decoration -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>
                
                {{ $slot }}
            </div>

            <!-- Footer -->
            <p class="relative z-10 text-blue-200 text-sm mt-8 mb-4">
                © {{ date('Y') }} RuangRapat. All rights reserved.
            </p>
        </div>
    </body>
</html>