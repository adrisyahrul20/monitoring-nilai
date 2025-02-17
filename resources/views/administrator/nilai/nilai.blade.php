<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Rapor Asesmen Tengah Semester</h1>
            @if (Auth::user()->role === 'siswa')
                <div class="flex gap-2 items-center">
                    <p class="text-sm">Semester: </p>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div class="capitalize">{{ $semester }}</div>
    
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin.nilai.nilai', ['siswa' => $siswa, 'semester' => 'ganjil'])">
                                Ganjil
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.nilai.nilai', ['siswa' => $siswa, 'semester' => 'genap'])">
                                Genap
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <a href="{{ route('admin.nilai.index') }}" class="bg-yellow-500 text-black px-4 py-2 rounded-lg">
                    Kembali
                </a>
            @endif
        </div>

        <div class="flex justify-between items-center">
            <div class="flex flex-col dark:text-white">
                <p class="text-lg font-bold">NAMA : {{ $dataSiswa->nama }}</p>
                <p class="text-sm">NIS : {{ $dataSiswa->nis }}</p>
                <p class="text-sm">KELAS : {{ $dataSiswa->idKelas->kdkls }}</p>
            </div>
            <div class="flex gap-4">
                @if (Auth::user()->role === 'guru')
                    <a href="{{ route('admin.nilai.input.update', ['siswa' => $siswa, 'semester' => $semester]) }}"
                        class="bg-yellow-500 text-black px-4 py-2 rounded-lg">
                        Ubah Nilai
                    </a>
                @endif
                <a href="{{ route('export-pdf', ['siswa' => $siswa, 'semester' => $semester]) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg">
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
                @if (count($dataNilai) === 0)
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td colspan="4">
                                <div class="py-3">Nilai semester ini belum ada</div>
                            </td>
                        </tr>
                    </tbody>
                @else
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
                @endif
            </table>
        </div>
    </div>
</x-app-layout>
