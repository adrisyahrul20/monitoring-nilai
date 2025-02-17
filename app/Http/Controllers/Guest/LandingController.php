<?php

namespace App\Http\Controllers\Guest;

use App\Helper\ErrorHandler;
use App\Helper\FormatResponse;
use App\Http\Controllers\Controller;
use App\Models\KelasModel;
use App\Models\MataPelajaranModel;
use App\Models\NilaiModel;
use App\Models\NilaiSiswaModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use stdClass;

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
        return view('index');
    }

    public function raport(Request $request)
    {
        $semester = $request->input('semester');
        $siswa = $request->input('siswa');

        $dataSiswa = $this->siswa->where('nis', $siswa)->first();
        $dataNilai = $this->table->where('idsiswa', $dataSiswa->id)->where('semester', $semester)->get();
        return view('guestrapor')->with([
            'dataNilai' => $dataNilai,
            'dataSiswa' => $dataSiswa,
            'semester' => $semester,
            'siswa' => $siswa,
        ]);
    }

    public function statistik(Request $request)
    {
        $siswa = $request->query('siswa');
        $semester = $request->query('semester');
        $dataSiswa = $this->siswa->where('nis', $siswa)->first();
        $namaSiswa = $dataSiswa->nama;
        return view('gueststatistik')->with([
            "siswa" => $siswa,
            "semester" => $semester,
            "namaSiswa" => $namaSiswa,
        ]);
    }

    public function chart(Request $request)
    {
        $siswa = $request->query('siswa');
        $semester = $request->query('semester');
        try {
            $dataSiswa = $this->siswa->where('nis', $siswa)->first();
            $data = NilaiModel::where('idsiswa', $dataSiswa->id)->where('semester', $semester)->get();

            $dataResponse = [];
            foreach ($data as $list) {
                $obj = new stdClass;
                $obj->kdmapel = $list->idMapel->kdmapel;
                $obj->pelajaran = $list->idMapel->nmmapel;
                $obj->nilai = $list->nilai;
                $dataResponse[] = $obj;
            }

            return FormatResponse::send(true, $dataResponse, "Berhasil mendapatkan data chart!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }
}
