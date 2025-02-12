<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\KelasModel;
use App\Models\MataPelajaranModel;
use App\Models\NilaiModel;
use App\Models\NilaiSiswaModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    protected $table;
    protected $mapel;
    protected $siswa;
    protected $kelas;
    protected $nilaiSiswa;

    public function __construct(NilaiModel $table, NilaiSiswaModel $nilaiSiswa, MataPelajaranModel $mapel, SiswaModel $siswa, KelasModel $kelas)
    {
        $this->table = $table;
        $this->mapel = $mapel;
        $this->siswa = $siswa;
        $this->kelas = $kelas;
        $this->nilaiSiswa = $nilaiSiswa;
    }

    public function index()
    {
        return view('statistik');
    }

    public function raport()
    {
        $search = null;
        $dataSiswa = $this->siswa->orderBy('id', 'asc')->get();
        foreach ($dataSiswa as $data) {
            $dataNilaiSiswa = $this->nilaiSiswa->where('idsiswa', $data->id)->where('tingkat_kelas', $data->idKelas->tingkat_kelas)->first();
            $dataRes = [
                'id' => $data->id,
                'nis' => $data->nis,
                'nama' => $data->nama,
                'kdkls' => $data->idKelas->kdkls,
                'ganjil' => $dataNilaiSiswa->ganjil ?? 0,
                'genap' => $dataNilaiSiswa->genap ?? 0,
            ];
            $dataShow[] = $dataRes;
        }
        return view('guest')->with([
            'search' => $search,
            'dataShow' => $dataShow ?? []
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $dataSiswa = $this->siswa
            ->where(function ($query) use ($search) {
                $query->where('nis', 'LIKE', '%' . $search . '%')
                    ->orWhere('nama', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('idKelas', function ($query) use ($search) {
                        $query->where('kdkls', 'LIKE', '%' . $search . '%');
                    });
            })
            ->orderBy('id', 'asc')
            ->get();
        $dataShow = [];
        foreach ($dataSiswa as $data) {
            $dataNilaiSiswa = $this->nilaiSiswa->where('idsiswa', $data->id)->where('tingkat_kelas', $data->idKelas->tingkat_kelas)->first();
            $dataRes = [
                'id' => $data->id,
                'nis' => $data->nis,
                'nama' => $data->nama,
                'kdkls' => $data->idKelas->kdkls,
                'ganjil' => $dataNilaiSiswa->ganjil ?? 0,
                'genap' => $dataNilaiSiswa->genap ?? 0,
            ];
            $dataShow[] = $dataRes;
        }
        return view('guest')->with([
            'search' => $search,
            'dataSiswa' => $dataSiswa,
            'dataShow' => $dataShow ?? [],
        ]);
    }

    public function nilai(Request $request)
    {
        $semester = $request->input('semester');
        $siswa = $request->input('siswa');

        $dataSiswa = $this->siswa->where('id', $siswa)->first();
        $dataNilai = $this->table->where('idsiswa', $siswa)->where('semester', $semester)->get();
        return view('guestnilai')->with([
            'dataNilai' => $dataNilai,
            'dataSiswa' => $dataSiswa,
            'semester' => $semester,
            'siswa' => $siswa,
        ]);
    }
}
