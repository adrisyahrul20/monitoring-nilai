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
use Illuminate\Support\Facades\DB;

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
        return view('administrator.dashboard.index');
    }

    public function chart()
    {
        try {
            $data = NilaiModel::select(
                'mata_pelajaran.kdmapel as mata_pelajaran', // Add kdmapel
                'mata_pelajaran.nmmapel',
                DB::raw('SUM(CASE WHEN nilai >= 80 THEN 1 ELSE 0 END) as lulus'),
                DB::raw('SUM(CASE WHEN nilai < 80 THEN 1 ELSE 0 END) as tidak_lulus')
            )
                ->join('mata_pelajaran', 'monitoring_nilai.idmtpelajaran', '=', 'mata_pelajaran.id')
                ->groupBy('mata_pelajaran.kdmapel', 'mata_pelajaran.nmmapel') // Include kdmapel in groupBy
                ->get();

            return FormatResponse::send(true, $data, "Berhasil mendapatkan data chart!", 200);
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
