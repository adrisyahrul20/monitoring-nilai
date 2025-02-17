<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Nilai {{ $dataSiswa->nama }}</title>
    <style>
        @page {
            size: A4 potrait;
            margin-top: 5mm;
            margin-left: 10mm;
            margin-right: 10mm;
        }

        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.border th,
        table.border td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h4,
        p {
            margin: 0;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .pull-right {
            float: right;
        }

        .pull-left {
            float: left;
        }

        .text-xs {
            font-size: 12px;
        }

        .text-sm {
            font-size: 14px;
        }

        .logo-img {
            width: 50px;
            height: auto;
        }

        .mb-4 {
            margin-bottom: 10px;
        }

        .mb-6 {
            margin-bottom: 30px;
        }

        .mb-10 {
            margin-bottom: 70px;
        }

        .mt-2 {
            margin-top: 20px;
        }

        .w-sper {
            width: 75%;
        }

        .w-full {
            width: 100%;
        }

        .align-top th,
        .align-top td {
            vertical-align: top;
        }
    </style>
    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
</head>

<body>
    <table class="mb-4">
        <tr>
            <td>
                <img src="{{ public_path('assets/img/logo.png') }}" alt="logo" class="logo-img pull-left" />
            </td>
            <td>
                <h4 class="text-center w-full">PEMERINTAH PROVINSI SUMATERA BARAT</h4>
                <h4 class="text-center w-full">CABANG DINAS PENDIDIKAN WILAYAH VII</h4>
                <h4 class="text-center w-full">SMA NEGERI 2 BAYANG</h4>
                <p class="text-xs text-center">Alamat: Jalan Gr-Panjang-Bayang, Telp.(0756)441069, E-Mail
                    smanbayang02@gmail.com</p>
            </td>
            <td>
                <img src="{{ public_path('assets/img/tutwurihandayani.png') }}" alt="logo"
                    class="logo-img pull-right" />
            </td>
        </tr>
    </table>
    <h3 class="text-center">RAPOR ASESMEN TENGAH SEMESTER</h3>
    <table class="info-table">
        <tbody>
            <tr>
                <td width="50px"><strong>NAMA :</strong></td>
                <td width="200px">{{ $dataSiswa->nama }}</td>
                <td width="50px"><strong>KELAS :</strong></td>
                <td width="80px">{{ $dataSiswa->idKelas->kdkls ?? '-' }}</td>
            </tr>
            <tr>
                <td width="50px"><strong>NIS :</strong></td>
                <td width="200px">{{ $dataSiswa->nis }}</td>
                <td width="50px"><strong>SEMESTER :</strong></td>
                <td width="80px">{{ strtoupper($semester) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="border">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Capaian Kompetensi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($dataNilai as $nilai)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $nilai->idMapel->nmmapel ?? '-' }}</td>
                    <td>{{ $nilai->nilai ?? '-' }}</td>
                    <td>{{ $nilai->capaian ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-right mb-10 mt-2">
        <p>Kab. Pesisir Selatan, {{ Carbon::now()->timezone('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
        <p>Wali Kelas,</p>
    </div>

    <div class="text-right">
        <p><strong>{{ $dataSiswa->idKelas->idGuru->nama }}</strong></p>
        <p>NIP: {{ $dataSiswa->idKelas->idGuru->nip }}</p>
    </div>
</body>

</html>
