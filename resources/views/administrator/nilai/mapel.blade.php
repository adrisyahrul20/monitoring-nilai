<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 dark:text-white">
        <div class="flex flex-col md:flex-row text-center justify-between items-center gap-4">
            <div class="flex flex-col text-left">
                <h1 class="text-xl md:text-2xl font-semibold capitalize">Nama Siswa : {{ strtolower($dataSiswa->nama) }}
                </h1>
                <p class="text-gray-500">NIS: {{ strtolower($dataSiswa->nis) }}</p>
            </div>
            <div class="flex gap-4">
                <h3 class="text-xl capitalize">Semester: {{ $semester }}</h3>
                <button onclick="window.history.back()" class="bg-yellow-500 text-black px-4 py-1 rounded-lg">
                    Kembali
                </button>
            </div>
        </div>
        <div class="relative overflow-x-auto mt-4">
            <form action="{{ route('admin.nilai.store') }}" method="POST">
                @csrf
                <input type="hidden" id="idsiswa" name="idsiswa" value="{{ $dataSiswa->id }}">
                <input type="hidden" id="semester" name="semester" value="{{ $semester }}">
                <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
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
                        @foreach ($dataMapel as $list)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input type="hidden" id="idmtpelajaran_{{ $list->id }}"
                                        name="idmtpelajaran[{{ $list->id }}]" value="{{ $list->id }}">
                                    {{ $list->nmmapel }}
                                </th>
                                <td class="px-6 py-4">
                                    <input type="number" id="nilai_{{ $list->id }}"
                                        name="nilai[{{ $list->id }}]" min="0" max="100"
                                        class="border shadow-sm rounded-md py-2 px-3 w-20 text-black" required>
                                </td>
                                <td class="px-6 py-4">
                                    <textarea id="capaian_{{ $list->id }}" name="capaian[{{ $list->id }}]"
                                        class="border shadow-sm rounded-md py-2 px-3 w-full text-black"></textarea>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-end my-4 gap-4">
                    <button type="button" onclick="window.history.back()"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
