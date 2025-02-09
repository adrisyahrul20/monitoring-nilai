<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ErrorHandler;
use App\Helper\FormatResponse;
use App\Http\Controllers\Controller;
use App\Models\GuruModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class GuruController extends Controller
{
    protected $table;

    public function __construct(GuruModel $table)
    {
        $this->table = $table;
    }

    public function index()
    {
        return view('administrator.guru.index');
    }

    public function datatable()
    {
        return DataTables::of($this->table->orderBy('created_at', 'desc')->select([
            'id',
            'nip',
            'nama',
            'templahir',
            'tgllahir',
            'jk',
            'alamat',
            'nohp',
            'email',
            'foto',
        ]))
            ->addIndexColumn()
            ->addColumn('fotoCast', function ($row) {
                if ($row->foto) {
                    $foto = '<img src="' . asset('storage/' . $row->foto) . '" class="w-16" alt="TE Logo" loading="lazy" />';
                } else {
                    $foto = '<img src="' . asset("assets/img/user.png") . '" class="w-16" alt="TE Logo" loading="lazy" />';
                }
                return $foto ?? 'Error';
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
                'nip' => 'required|string|max:255|unique:guru,nip',
                'name' => 'required|string|max:255',
                'templahir' => 'required|string|max:255',
                'tgllahir' => 'required|string',
                'jenkel' => 'required|in:lk,pr',
                'notelp' => 'required|string|max:14',
                'email' => 'required|string|email|max:255',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = new $this->table;
            $store->nip = $request->nip;
            $store->nama = $request->name;
            $store->templahir = $request->templahir;
            $store->tgllahir = $request->tgllahir;
            $store->jk = $request->jenkel;
            $store->nohp = $request->notelp;
            $store->email = $request->email;
            $store->alamat = $request->alamat;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->move('public/uploads', $filename);

                $store->foto = str_replace('public/', '', $filePath);
            }

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
                'nip' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'templahir' => 'required|string|max:255',
                'tgllahir' => 'required|string',
                'jenkel' => 'required|in:lk,pr',
                'notelp' => 'required|string|max:14',
                'email' => 'required|string|email|max:255',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = $this->table->find($request->id);
            $store->nip = $request->nip;
            $store->nama = $request->name;
            $store->templahir = $request->templahir;
            $store->tgllahir = $request->tgllahir;
            $store->jk = $request->jenkel;
            $store->nohp = $request->notelp;
            $store->email = $request->email;
            $store->alamat = $request->alamat;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->move('public/uploads', $filename);

                $store->foto = str_replace('public/', '', $filePath);
            }
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
