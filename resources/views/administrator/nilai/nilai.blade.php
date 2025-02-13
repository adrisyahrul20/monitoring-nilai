<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Nilai Siswa</h1>
            <div class="flex gap-4 items-center">
                <button onclick="window.history.back()" class="bg-yellow-500 text-black px-4 py-2 rounded-lg">
                    Kembali
                </button>
            </div>
        </div>
        
        <div class="flex justify-between items-center">
            <div class="flex flex-col dark:text-white">
                <p class="text-lg font-bold">NAMA : {{ $dataSiswa->nama }}</p>
                <p class="text-sm">NIS : {{ $dataSiswa->nis }}</p>
                <p class="text-sm">KELAS : {{ $dataSiswa->idKelas->kdkls }}</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.nilai.input.update', ['siswa' => $siswa, 'semester' => $semester]) }}" class="bg-yellow-500 text-black px-4 py-2 rounded-lg">
                    Ubah Nilai
                </a>
                <a href="{{ route('export-pdf', ['siswa' => $siswa, 'semester' => $semester]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Export PDF
                </a>
            </div>
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
</x-app-layout>
