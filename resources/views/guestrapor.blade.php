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

    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 dark:text-white/50">
    @include('layouts.guestnav')

    <div class="max-w-7xl mx-auto text-black/80 py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Rapor Asesmen Tengah Semester</h1>
        </div>
        <div class="flex justify-between items-center">
            <div class="flex flex-col dark:text-white">
                <p class="text-lg font-bold">NAMA : {{ $dataSiswa->nama }}</p>
                <p class="text-sm">NIS : {{ $dataSiswa->nis }}</p>
                <p class="text-sm">KELAS : {{ $dataSiswa->idKelas->kdkls }}</p>
            </div>
            <a href="{{ route('export-pdf', ['siswa' => $siswa, 'semester' => $semester]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Export PDF
            </a>
        </div>
        <div class="relative overflow-x-auto mt-4">
            <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Mata Pelajaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Capaian Kompetensi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($dataNilai as $list)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                {{ $no++ }}
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-left">
                                {{ $list->idMapel->nmmapel }}
                            </th>
                            <td class="px-6 py-4">
                                {{ (int) $list->nilai }}
                            </td>
                            <td width="600" class="px-6 py-4 text-left">
                                {{ $list->capaian }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
