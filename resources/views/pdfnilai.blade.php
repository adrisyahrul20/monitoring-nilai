<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai {{ $dataSiswa->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .info-table td {
            border: none;
            padding: 5px;
        }

        .info-table {
            margin-bottom: 20px;
        }

        .text-right {
            text-align: right;
        }

        .mb-5 {
            margin-bottom: 80px;
        }
    </style>
    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
</head>

<body>
    <h2>Nilai Siswa</h2>

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

    <table>
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
    <div class="text-right mb-5">
        <p>Kab. Pesisir Selatan, {{ Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Wali Kelas,</p>
    </div>

    <div class="text-right">
        <p><strong>{{ $dataSiswa->idKelas->idGuru->nama }}</strong></p>
        <p>NIP: {{ $dataSiswa->idKelas->idGuru->nip }}</p>
    </div>
</body>

</html>
