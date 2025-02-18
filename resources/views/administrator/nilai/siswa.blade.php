<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Siswa Kelas {{ $dataKelas->kdkls }}</h1>
            <div class="flex gap-4 items-center">
                <p class="dark:text-white">Pilih Semester: </p>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-800 dark:text-white/80 bg-gray-300 dark:bg-gray-600 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
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
                        <x-dropdown-link :href="route('admin.nilai.input.siswa') . '?kelas=' . $dataKelas->id . '&semester=ganjil'">
                            Ganjil
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.nilai.input.siswa') . '?kelas=' . $dataKelas->id . '&semester=genap'">
                            Genap
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                <a href="{{ route('admin.nilai.index') }}" class="bg-yellow-500 text-black px-4 py-1 rounded-lg">
                    Kembali
                </a>
            </div>
        </div>
        <div class="relative overflow-x-auto mt-4">
            <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            NIS
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NAMA
                        </th>
                        <th scope="col" class="px-6 py-3">
                            STATUS
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
                                {{ $list['nis'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $list['nama'] }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    {!! $list['status']
                                        ? '<div class="btn bg-green-500 rounded-full px-4 py-1 text-white w-fit">Sudah Dinilai</div>'
                                        : '<div class="btn bg-red-500 rounded-full px-4 py-1 text-white w-fit">Belum Dinilai</div>' !!}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if (!$list['status'])
                                    <a href="{{ route('admin.nilai.input.mapel') }}?siswa={{ $list['id'] }}&semester={{ $semester }}"
                                        class="btn bg-blue-500 text-white rounded-lg px-4 py-2">
                                        Nilai Siswa</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
