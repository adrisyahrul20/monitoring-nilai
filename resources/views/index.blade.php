<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monitor Nilai Siswa SMA N 2 Bayang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #6b728000;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #374151;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 dark:text-white/50">
    @include('layouts.guestnav')

    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col text-center items-center justify-center min-h-[calc(100dvh-200px)] gap-4">
            <x-login-logo class="block w-24 h-auto fill-current text-gray-800 dark:text-gray-200" />
            <div class="flex flex-col">
                <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Selamat datang di aplikasi monitoring
                    nilai murid</h1>
                <h1 class="text-xl md:text-2xl font-semibold dark:text-white">SMA NEGERI 2 BAYANG</h1>
                <p class="text-base dark:text-white">Silahkan login untuk mengakses aplikasi ini</p>
            </div>
        </div>
    </div>

</body>

</html>
