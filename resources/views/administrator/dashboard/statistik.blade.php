<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Statistik Nilai {{ $namaSiswa }}</h1>
            <div class="flex gap-4">
                @if (Auth::user()->role === 'siswa')
                    <div class="flex gap-2 items-center">
                        <p class="text-sm">Semester: </p>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div class="capitalize">{{ $semester }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.dashboard.statistik', [
                                    'siswa' => $siswa,
                                    'semester' => 'ganjil',
                                ])">
                                    Ganjil
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.dashboard.statistik', [
                                    'siswa' => $siswa,
                                    'semester' => 'genap',
                                ])">
                                    Genap
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <button id="copyButton" class="bg-blue-500 text-white px-4 py-1 rounded-lg">
                        Bagikan
                    </button>
                    <a href="{{ route('admin.dashboard.index') }}"
                        class="bg-yellow-500 text-black px-4 py-1 rounded-lg">
                        Kembali
                    </a>
                @endif
            </div>
        </div>
        <div class="relative overflow-x-auto mt-4">
            <canvas id="myChart"></canvas>
            <div id="emptyState" class="dark:text-white h-[calc(100dvh-400px)] flex items-center justify-center">
                Semester ini belum ada nilai</div>
        </div>
    </div>
    <script>
        $('#copyButton').click(function() {
            let text = `{!! route('statistik-page', ['siswa' => $siswa, 'semester' => $semester]) !!}`;
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Tersalin!',
                    text: 'Link URL disalin.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal menyalin URL',
                });
            });
        });

        const siswa = "{{ $siswa }}";
        const semester = "{{ $semester }}";
        const chartRoute = `{{ route('admin.dashboard.chart') }}?siswa=${siswa}&semester=${semester}`;

        fetch(chartRoute)
            .then(response => response.json())
            .then(response => {
                const data = response.data;
                if (data.length === 0) {
                    $('#myChart').addClass('!hidden');
                } else {
                    $('#myChart').removeClass('!hidden');
                }
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
</x-app-layout>
