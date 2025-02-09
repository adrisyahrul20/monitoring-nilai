<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 dark:text-white">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold">Nilai Siswa</h1>
        </div>
        <div class="relative overflow-x-auto mt-4">
            <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Kode Mata Pelajaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tingkat Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Mata Pelajaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Siswa Ternilai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Guru Pengampu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataShow as $list)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $list['kdmapel'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $list['tingkat_kelas'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $list['nmmapel'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $list['siswa_ternilai'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $list['guru'] }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.nilai.mapel') }}?mapel={{ $list['id'] }}" class="btn bg-yellow-500 text-black rounded-lg px-4 py-1">Buat
                                    Nilai Siswa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
