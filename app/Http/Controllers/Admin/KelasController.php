<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ErrorHandler;
use App\Helper\FormatResponse;
use App\Http\Controllers\Controller;
use App\Models\GuruModel;
use App\Models\KelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    protected $table;
    protected $guru;

    public function __construct(KelasModel $table, GuruModel $gurus)
    {
        $this->table = $table;
        $this->guru = $gurus;
    }

    public function index()
    {
        $dataGuru = $this->guru->select('id','nama')->get();
        return view('administrator.kelas.index')->with([
            'dataGuru' => $dataGuru
        ]);
    }

    public function datatable()
    {
        return DataTables::of($this->table->orderBy('created_at', 'desc')->select([
            'id',
            'kdkls',
            'jmlbangku',
            'idguru',
        ]))
            ->addIndexColumn()
            ->addColumn('namaGuru', function ($row) {
                return $row->idGuru->nama ?? 'Guru Tidak Ada';
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
                'kdkls' => 'required|string|max:255|unique:kelas,kdkls',
                'jmlbangku' => 'required|integer',
                'idguru' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = new $this->table;
            $store->kdkls = $request->kdkls;
            $store->jmlbangku = $request->jmlbangku;
            $store->idguru = $request->idguru;
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
                'kdkls' => 'required|string|max:255',
                'jmlbangku' => 'required|integer',
                'idguru' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = $this->table->find($request->id);
            $store->kdkls = $request->kdkls;
            $store->jmlbangku = $request->jmlbangku;
            $store->idguru = $request->idguru;
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
