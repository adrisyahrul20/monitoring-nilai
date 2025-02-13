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
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Statistik Nilai Siswa</h1>
        </div>
        <div class="relative overflow-x-auto mt-4">
            <canvas id="myChart"></canvas>

        </div>
        <div id="dataModal"
            class="fixed inset-0 flex items-center justify-center z-[1100] hidden bg-black bg-opacity-50">
            <div class="bg-gray-100 dark:bg-gray-700 dark:text-white rounded-lg shadow-lg w-full max-w-lg mx-auto p-6">
                <h2 id="modalTitle" class="text-xl font-semibold"></h2>
                <p id="modalStatus" class="text-sm mb-4"></p>
                <div class="relative max-h-[400px] mt-4 border">
                    <table
                        class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 border-collapse">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                            <tr>
                                <th scope="col" class="px-6 py-3">NO</th>
                                <th scope="col" class="px-6 py-3">NAMA</th>
                                <th scope="col" class="px-6 py-3">NILAI</th>
                            </tr>
                        </thead>
                    </table>
                    <div
                        class="overflow-y-auto max-h-[350px] scrollbar-thin scrollbar-thumb-gray-500 scrollbar-track-gray-200">
                        <table
                            class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 border-collapse">
                            <tbody id="bodyTable">
                                <!-- Dynamic Data Here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="button" id="close-modal"
                        class="bg-gray-500 text-white rounded-lg px-4 py-2 mr-2">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#close-modal').click(function() {
            $('#dataModal').addClass('hidden');
        });

        fetch("{{ route('admin.dashboard.chart') }}")
            .then(response => response.json())
            .then(response => {
                const data = response.data;
                const labels = data.map(item => item.mata_pelajaran);
                const lulusData = data.map(item => item.lulus);
                const tidakLulusData = data.map(item => item.tidak_lulus);
                const longLabels = data.map(item => item.nmmapel);

                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Tuntas',
                                data: lulusData,
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Tidak Tuntas',
                                data: tidakLulusData,
                                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        onClick: function(event, elements) {
                            if (elements.length > 0) {
                                const index = elements[0].index;
                                const datasetIndex = elements[0].datasetIndex;
                                const selectedLabel = labels[index];
                                const selectedLongLabel = longLabels[index];
                                const selectedStatus = datasetIndex === 0 ? 'Tuntas' : 'Tidak Tuntas';

                                $('#dataModal').removeClass('hidden');
                                fetch(
                                        `{{ route('admin.dashboard.chart.detail') }}?kdmapel=${selectedLabel}&status=${selectedStatus}`
                                    )
                                    .then(response => response.json())
                                    .then(detailData => {
                                        let tbodyContent = "";

                                        if (detailData.data.length > 0) {
                                            detailData.data.forEach((item, idx) => {
                                                tbodyContent += `
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-6 py-4">${idx + 1}</td>
                                                        <td class="px-6 py-4">${item.nama_siswa}</td>
                                                        <td class="px-6 py-4">${item.nilai}</td>
                                                    </tr>
                                                `;
                                            });

                                        } else {
                                            tbodyContent = `
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center">Tidak ada data</td>
                                        </tr>
                                    `;
                                        }
                                        $('#modalTitle').text('Mata Pelajaran : ' + selectedLongLabel);
                                        $('#modalStatus').text('Daftar siswa : ' + selectedStatus);
                                        $('#bodyTable').html(tbodyContent);
                                    })
                                    .catch(error => console.error('Error fetching detail:', error));
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>

</html>
