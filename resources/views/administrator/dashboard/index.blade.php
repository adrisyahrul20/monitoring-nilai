<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row text-center justify-between gap-4">
            <h1 class="text-xl md:text-2xl font-semibold dark:text-white">Nilai Siswa</h1>
            <div class="flex gap-4 items-center">
                <form action="{{ route('admin.dashboard.search') }}" method="POST" class="flex">
                    @csrf
                    <input type="text" id="cari" name="search"
                        class="border shadow-sm rounded-l-lg py-2 px-3 w-72 text-black"
                        placeholder="Cari NIS, NAMA, atau KELAS siswa" autocomplete="off" value="{{ $search }}">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg">
                        Cari
                    </button>
                </form>
                @if($search)
                <a href="{{ route('admin.dashboard.index') }}" class="bg-yellow-500 text-black px-4 py-2 rounded-lg">
                    Kembali
                </a>
                @endif
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
                            KELAS
                        </th>
                        <th scope="col" class="px-6 py-3">
                            SEMESTER GANJIL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            SEMESTER GENAP
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
                                {{ $list['kdkls'] }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    {!! $list['ganjil']
                                        ? '<a href="' .
                                            route('admin.dashboard.nilai', ['siswa' => $list['id'], 'semester' => 'ganjil']) .
                                            '" class="btn bg-blue-500 rounded-lg px-4 py-1 text-white w-fit cursor-pointer">Lihat Nilai</a>'
                                        : '<div class="btn bg-gray-500 rounded-lg px-4 py-1 text-white w-fit cursor-not-allowed">Belum Dinilai</div>' !!}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    {!! $list['genap']
                                        ? '<a href="' .
                                            route('admin.dashboard.nilai', ['siswa' => $list['id'], 'semester' => 'genap']) .
                                            '" class="btn bg-blue-500 rounded-lg px-4 py-1 text-white w-fit cursor-pointer">Lihat Nilai</a>'
                                        : '<div class="btn bg-gray-500 rounded-lg px-4 py-1 text-white w-fit cursor-not-allowed">Belum Dinilai</div>' !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
