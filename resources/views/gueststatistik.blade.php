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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 dark:text-white/50">
    @include('layouts.guestnav')

    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Statistik Nilai {{ $namaSiswa }}</h1>
        </div>
        <div class="relative overflow-x-auto mt-4">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <script>
        const siswa = "{{ $siswa }}";
        const semester = "{{ $semester }}";
        const chartRoute = `{{ route('statistik-chart') }}?siswa=${siswa}&semester=${semester}`;

        fetch(chartRoute)
            .then(response => response.json())
            .then(response => {
                const data = response.data;
                const tooltip = data.map(item => item.pelajaran);
                const labels = data.map(item => item.kdmapel);
                const scores = data.map(item => parseFloat(item.nilai));

                const backgroundColors = scores.map(score => score >= 80 ? 'rgba(75, 192, 192, 0.6)' :
                    'rgba(255, 99, 132, 0.6)');
                const borderColors = scores.map(score => score >= 80 ? 'rgba(75, 192, 192, 1)' :
                    'rgba(255, 99, 132, 1)');

                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Nilai Siswa',
                            data: scores,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    generateLabels: function(chart) {
                                        return [{
                                                text: 'Tuntas (≥ 80)',
                                                fillStyle: 'rgba(75, 192, 192, 0.6)',
                                                strokeStyle: 'rgba(75, 192, 192, 1)',
                                                lineWidth: 1,
                                                fontColor: '#666666'
                                            },
                                            {
                                                text: 'Tidak Tuntas (< 80)',
                                                fillStyle: 'rgba(255, 99, 132, 0.6)',
                                                strokeStyle: 'rgba(255, 99, 132, 1)',
                                                lineWidth: 1,
                                                fontColor: '#666666'
                                            }
                                        ];
                                    },
                                },
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        const subject = tooltip[tooltipItem.dataIndex];
                                        const score = scores[tooltipItem.dataIndex];
                                        return `Nilai ${subject}: ${score}`;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>

</html>
