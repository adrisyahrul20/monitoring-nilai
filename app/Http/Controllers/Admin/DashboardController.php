<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ErrorHandler;
use App\Helper\FormatResponse;
use App\Http\Controllers\Controller;
use App\Models\KelasModel;
use App\Models\MataPelajaranModel;
use App\Models\NilaiModel;
use App\Models\NilaiSiswaModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class DashboardController extends Controller
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
        if(Auth::user()->role === 'siswa') {
            return redirect()->route('admin.dashboard.statistik', ['siswa' => Auth::user()->idSiswa->nis, 'semester' => 'ganjil']);
        } elseif(Auth::user()->role === 'admin') {
            return redirect()->route('admin.siswa.index');
        } else {
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
            return view('administrator.dashboard.index')->with([
                'search' => $search,
                'dataSiswa' => $dataSiswa,
                'dataShow' => $dataShow ?? [],
            ]);
        }
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
        return view('administrator.dashboard.index')->with([
            'search' => $search,
            'dataSiswa' => $dataSiswa,
            'dataShow' => $dataShow ?? [],
        ]);
    }

    public function statistik(Request $request)
    {
        $siswa = $request->query('siswa');
        $semester = $request->query('semester');
        $dataSiswa = $this->siswa->where('nis', $siswa)->first();
        $namaSiswa = $dataSiswa->nama;
        return view('administrator.dashboard.statistik')->with([
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

    public function detail(Request $request)
    {
        try {
            $kdmapel = $request->query('kdmapel');
            $status = $request->query('status');

            if (!$kdmapel || !$status) {
                return FormatResponse::send(false, null, "Invalid parameters!", 400);
            }

            $query = NilaiModel::select('siswa.nama as nama_siswa', 'nilai', 'capaian')
                ->join('siswa', 'monitoring_nilai.idsiswa', '=', 'siswa.id')
                ->join('mata_pelajaran', 'monitoring_nilai.idmtpelajaran', '=', 'mata_pelajaran.id')
                ->where('mata_pelajaran.kdmapel', $kdmapel);


            if ($status == 'Tuntas') {
                $query->where('nilai', '>=', 80);
            } else {
                $query->where('nilai', '<', 80);
            }

            $data = $query->get();



            return FormatResponse::send(true, $data, "Berhasil mendapatkan data Detail!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }
}
