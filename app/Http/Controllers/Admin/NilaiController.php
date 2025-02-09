<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ErrorHandler;
use App\Helper\FormatResponse;
use App\Http\Controllers\Controller;
use App\Models\MataPelajaranModel;
use App\Models\NilaiModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use stdClass;
use Yajra\DataTables\DataTables;

class NilaiController extends Controller
{
    protected $table;
    protected $mapel;
    protected $siswa;

    public function __construct(NilaiModel $table, MataPelajaranModel $mapel, SiswaModel $siswa)
    {
        $this->table = $table;
        $this->mapel = $mapel;
        $this->siswa = $siswa;
    }

    public function index()
    {
        $dataMapel = $this->mapel->get();
        $dataShow = [];
        foreach ($dataMapel as $data) {
            $dataNilai = $this->table->where('idmtpelajaran', $data->id)->get();
            $dataRes = [
                'id' => $data->id,
                'kdmapel' => $data->kdmapel,
                'tingkat_kelas' => $data->tingkat_kelas,
                'nmmapel' => $data->nmmapel,
                'guru' => $data->idGuru->nama,
                'siswa_ternilai' => count($dataNilai),
            ];
            $dataShow[] = $dataRes;
        }

        return view('administrator.nilai.index')->with([
            'dataShow' => $dataShow,
        ]);
    }

    public function nilai(Request $request)
    {
        $idMapel = $request->query('mapel');
        $dataMapel = $this->mapel->where('id', $idMapel)->first();
        $dataSiswa = $this->siswa->get();
        return view('administrator.nilai.mapel')->with([
            'idMapel' => $idMapel,
            'dataSiswa' => $dataSiswa,
            'dataMapel' => $dataMapel,
        ]);
    }

    public function datatable(Request $request)
    {
        $idMapel = $request->query('mapel');
        return DataTables::of($this->table->where('idmtpelajaran', $idMapel)->orderBy('created_at', 'desc')->select([
            'id',
            'idsiswa',
            'semester',
            'nilai',
        ]))
            ->addIndexColumn()
            ->addColumn('siswa', function ($row) {
                return $row->idSiswa->nama ?? 'Siswa Tidak Ada';
            })
            ->addColumn('tingkat_kelas', function ($row) {
                return $row->idSiswa->idKelas->tingkat_kelas ?? 'Siswa Tidak Ada';
            })
            ->addColumn('jurusan', function ($row) {
                return $row->idSiswa->idKelas->jurusan ?? 'Siswa Tidak Ada';
            })
            ->addColumn('semesterCast', function ($row) {
                return $row->semester === 'ganjil' ? "Ganjil" : "Genap";
            })
            ->addColumn('action', function ($row) {
                return '
                <div class="flex justify-center gap-3">
                    <button type="button" class="text-blue-500 text-2xl" data-mode="edit" data-id="' . $row->id . '">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="text-red-500 text-2xl" data-mode="destroy" data-id="' . $row->id . '">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['fotoCast', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'idmtpelajaran' => 'required|string|max:255',
                'idsiswa' => 'required|string|max:255',
                'semester' => 'required|string|max:255',
                'nilai' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = new $this->table;
            $store->idmtpelajaran = $request->idmtpelajaran;
            $store->idsiswa = $request->idsiswa;
            $store->semester = $request->semester;
            $store->nilai = $request->nilai;
            $store->save();

            return FormatResponse::send(true, null, "Tambah data berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'idmtpelajaran' => 'required|string|max:255',
                'idsiswa' => 'required|string|max:255',
                'semester' => 'required|string|max:255',
                'nilai' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = $this->table->find($request->id);
            $store->idmtpelajaran = $request->idmtpelajaran;
            $store->idsiswa = $request->idsiswa;
            $store->semester = $request->semester;
            $store->nilai = $request->nilai;
            $store->save();

            return FormatResponse::send(true, null, "Ubah data berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $destroy = $this->table->findOrFail($request->id);
            $destroy->delete();

            return FormatResponse::send(true, $destroy, "Hapus data berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }
}
