<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ErrorHandler;
use App\Helper\FormatResponse;
use App\Http\Controllers\Controller;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    protected $table;
    protected $kelas;

    public function __construct(SiswaModel $table, KelasModel $kelas)
    {
        $this->table = $table;
        $this->kelas = $kelas;
    }

    public function index()
    {
        $dataKelas = $this->kelas->select('id', 'kdkls', 'jmlbangku')->orderBy('kdkls', 'asc')->get();
        return view('administrator.siswa.index')->with([
            'dataKelas' => $dataKelas,
        ]);
    }

    public function datatable()
    {
        return DataTables::of($this->table->orderBy('nis', 'desc')->select([
            'id',
            'nis',
            'nama',
            'templahir',
            'tgllahir',
            'jk',
            'alamat',
            'idkelas',
        ]))
            ->addIndexColumn()
            ->addColumn('kelas', function ($row) {
                return $row->idKelas->kdkls ?? 'Mata Pelajaran Tidak Ada';
            })
            ->addColumn('jkCast', function ($row) {
                return $row->jk === 'lk' ? 'Laki-laki' : 'Perempuan';
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
                'nis' => 'required|string|max:255|unique:siswa,nis',
                'name' => 'required|string|max:255',
                'templahir' => 'required|string|max:255',
                'tgllahir' => 'required|string',
                'jenkel' => 'required|in:lk,pr',
                'idkelas' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $jumlahSiwa = $this->table->where('idkelas', $request->idkelas)->get();
            $QtySiswa = count($jumlahSiwa);

            $checkQtyKelas = $this->kelas->where('id', $request->idkelas)->first();

            if($checkQtyKelas->jmlbangku > $QtySiswa) {
                $store = new $this->table;
                $store->nis = $request->nis;
                $store->nama = $request->name;
                $store->templahir = $request->templahir;
                $store->tgllahir = $request->tgllahir;
                $store->jk = $request->jenkel;
                $store->alamat = $request->alamat;
                $store->idkelas = $request->idkelas;
                $store->save();

                return FormatResponse::send(true, null, "Tambah data berhasil!", 200);
            } else {
                return FormatResponse::send(false, null, "Tidak ada bangku kosong dikelas ini!", 400);
            }

        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nis' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'templahir' => 'required|string|max:255',
                'tgllahir' => 'required|string',
                'jenkel' => 'required|in:lk,pr',
                'idkelas' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = $this->table->find($request->id);
            $store->nis = $request->nis;
            $store->nama = $request->name;
            $store->templahir = $request->templahir;
            $store->tgllahir = $request->tgllahir;
            $store->jk = $request->jenkel;
            $store->alamat = $request->alamat;
            $store->idkelas = $request->idkelas;
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
