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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use stdClass;
use Yajra\DataTables\DataTables;

class NilaiController extends Controller
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
        return view('administrator.nilai.index')->with([
            'search' => $search,
            'dataSiswa' => $dataSiswa,
            'dataShow' => $dataShow ?? [],
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
        return view('administrator.nilai.index')->with([
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
        return view('administrator.nilai.nilai')->with([
            'dataNilai' => $dataNilai,
            'dataSiswa' => $dataSiswa,
            'semester' => $semester,
            'siswa' => $siswa,
        ]);
    }

    public function input()
    {
        $dataKelas = $this->kelas->orderBy('kdkls', 'asc')->get();
        $dataShow = [];
        foreach ($dataKelas as $data) {
            $dataSiswa = $this->siswa->where('idkelas', $data->id)->get();
            $dataRes = [
                'id' => $data->id,
                'kdkls' => $data->kdkls,
                'tingkat_kelas' => $data->tingkat_kelas,
                'jurusan' => $data->jurusan,
                'total_siswa' => count($dataSiswa),
                'guru' => $data->idGuru->nama,
            ];
            $dataShow[] = $dataRes;
        }

        return view('administrator.nilai.input')->with([
            'dataShow' => $dataShow,
        ]);
    }

    public function siswa(Request $request)
    {
        $idKelas = $request->query('kelas');
        $semester = $request->query('semester');
        $dataSiswa = $this->siswa->where('idkelas', $idKelas)->get();
        $dataKelas = $this->kelas->where('id', $idKelas)->first();
        foreach ($dataSiswa as $data) {
            $dataNilaiSiswa = $this->nilaiSiswa->where('idsiswa', $data->id)->where('tingkat_kelas', $data->idKelas->tingkat_kelas)->first();
            $dataRes = [
                'id' => $data->id,
                'nis' => $data->nis,
                'nama' => $data->nama,
                'status' => $semester === 'ganjil' ? $dataNilaiSiswa->ganjil ?? false : $dataNilaiSiswa->genap ?? false,
            ];
            $dataShow[] = $dataRes;
        }
        return view('administrator.nilai.siswa')->with([
            'semester' => $semester,
            'dataKelas' => $dataKelas,
            'dataSiswa' => $dataSiswa,
            'dataShow' => $dataShow ?? [],
        ]);
    }

    public function inputNilai(Request $request)
    {
        $idSiswa = $request->query('siswa');
        $semester = $request->query('semester');
        $dataMapel = $this->mapel->orderBy('id', 'asc')->get();
        $dataSiswa = $this->siswa->where('id', $idSiswa)->first();
        return view('administrator.nilai.mapel')->with([
            'semester' => $semester,
            'idSiswa' => $idSiswa,
            'dataMapel' => $dataMapel,
            'dataSiswa' => $dataSiswa,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'semester' => 'required|in:ganjil,genap',
                'idsiswa' => 'required|exists:siswa,id',
                'idmtpelajaran' => 'required|array',
                'idmtpelajaran.*' => 'required|integer|exists:mata_pelajaran,id',
                'nilai' => 'required|array',
                'nilai.*' => 'required|numeric|min:0|max:100',
                'capaian' => 'nullable|array',
                'capaian.*' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }


            foreach ($request->idmtpelajaran as $key => $idmtpelajaran) {
                $this->table::create([
                    'idmtpelajaran' => $idmtpelajaran,
                    'idsiswa' => $request->idsiswa,
                    'semester' => $request->semester ?? 'ganjil',
                    'nilai' => $request->nilai[$key] ?? null,
                    'capaian' => $request->capaian[$key] ?? null,
                ]);
            }

            $checkSiswa = $this->siswa->where('id', $request->idsiswa)->first();
            $createNilaiSiswa = new $this->nilaiSiswa();
            $createNilaiSiswa->idsiswa = $request->idsiswa;
            $createNilaiSiswa->tingkat_kelas = $checkSiswa->idKelas->tingkat_kelas;
            $createNilaiSiswa->ganjil = $request->semester === 'ganjil';
            $createNilaiSiswa->genap = $request->semester === 'genap';
            $createNilaiSiswa->save();

            return redirect()->route('admin.nilai.input.siswa', ['kelas' => $checkSiswa->idkelas, 'semester' => $request->semester])->with('success', 'Nilai siswa ' . $checkSiswa->nama . ' sudah diinput.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.nilai.input.input')->with('error', 'Terjadi kesalahan saat menginput nilai.');
        }
    }

    public function update(Request $request)
    {
        $semester = $request->input('semester');
        $siswa = $request->input('siswa');

        $dataSiswa = $this->siswa->where('id', $siswa)->first();
        $dataNilai = $this->table->where('idsiswa', $siswa)->where('semester', $semester)->get();
        return view('administrator.nilai.update')->with([
            'dataNilai' => $dataNilai,
            'dataSiswa' => $dataSiswa,
            'semester' => $semester,
            'siswa' => $siswa,
        ]);
    }

    public function putUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'semester' => 'required|in:ganjil,genap',
                'idsiswa' => 'required|exists:siswa,id',
                'idmtpelajaran' => 'required|array',
                'idmtpelajaran.*' => 'required|integer|exists:mata_pelajaran,id',
                'nilai' => 'required|array',
                'nilai.*' => 'required|numeric|min:0|max:100',
                'capaian' => 'nullable|array',
                'capaian.*' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }


            foreach ($request->idmtpelajaran as $key => $idmtpelajaran) {
                $this->table::updateOrInsert(
                    [
                        'idmtpelajaran' => $idmtpelajaran,
                        'idsiswa' => $request->idsiswa,
                        'semester' => $request->semester ?? 'ganjil',
                    ],
                    [
                        'nilai' => $request->nilai[$key] ?? null,
                        'capaian' => $request->capaian[$key] ?? null,
                        'updated_at' => now(),
                    ]
                );
            }

            $checkSiswa = $this->siswa->where('id', $request->idsiswa)->first();

            return redirect()->route('admin.nilai.nilai', ['siswa' => $checkSiswa->id, 'semester' => $request->semester])->with('success', 'Nilai siswa ' . $checkSiswa->nama . ' sudah diinput.');
        } catch (\Throwable $th) {
            $checkSiswa = $this->siswa->where('id', $request->idsiswa)->first();
            return redirect()->route('admin.nilai.nilai', ['siswa' => $checkSiswa->id, 'semester' => $request->semester])->with('error', $th->getMessage());
        }
    }
    
    // public function update(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'idmtpelajaran' => 'required|string|max:255',
    //             'idsiswa' => 'required|string|max:255',
    //             'semester' => 'required|string|max:255',
    //             'nilai' => 'required',
    //         ]);

    //         if ($validator->fails()) {
    //             throw new ValidationException($validator);
    //         }

    //         $store = $this->table->find($request->id);
    //         $store->idmtpelajaran = $request->idmtpelajaran;
    //         $store->idsiswa = $request->idsiswa;
    //         $store->semester = $request->semester;
    //         $store->nilai = $request->nilai;
    //         $store->save();

    //         return FormatResponse::send(true, null, "Ubah data berhasil!", 200);
    //     } catch (\Throwable $th) {
    //         return ErrorHandler::record($th, 'response');
    //     }
    // }

    // public function destroy(Request $request)
    // {
    //     try {
    //         $destroy = $this->table->findOrFail($request->id);
    //         $destroy->delete();

    //         return FormatResponse::send(true, $destroy, "Hapus data berhasil!", 200);
    //     } catch (\Throwable $th) {
    //         return ErrorHandler::record($th, 'response');
    //     }
    // }
}
