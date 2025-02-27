<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ErrorHandler;
use App\Helper\FormatResponse;
use App\Http\Controllers\Controller;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $table;
    protected $siswa;
    protected $kelas;

    public function __construct(User $table, SiswaModel $siswa, KelasModel $kelas)
    {
        $this->table = $table;
        $this->siswa = $siswa;
        $this->kelas = $kelas;
    }

    public function index()
    {
        $dataSiswa = $this->siswa->get();
        $dataKelas = $this->kelas->get();
        return view('administrator.users.index')->with([
            "dataSiswa" => $dataSiswa,
            "dataKelas" => $dataKelas,
        ]);
    }

    public function datatable()
    {
        return DataTables::of($this->table->orderBy('created_at', 'desc')->select([
            'id',
            'name',
            'email',
            'role',
            'idsiswa',
            'idkelas',
        ]))
            ->addIndexColumn()
            ->addColumn('roleCast', function ($row) {
                return $row->role === 'admin' ? 'Administrator' : ($row->role === 'guru' ? 'Guru Wali Kelas - ' . $row->idKelas->kdkls : ($row->role === 'kepsek' ? 'Kepala Sekolah' :
                            'Orang Tua - ' . $row->idSiswa->nama));
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
            ->rawColumns(['statusCast', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'role' => 'required|in:admin,guru,siswa,kepsek',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = new $this->table;
            $store->name = $request->name;
            $store->email = $request->email;
            $store->password = bcrypt($request->password);
            $store->role = $request->role;
            $store->save();

            return FormatResponse::send(true, ['record' => $store, 'act' => 'store'], "Registrasi berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function storeSiswa(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required',
                'idsiswa' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = new $this->table;
            $store->name = $request->name;
            $store->email = $request->email;
            $store->password = bcrypt($request->password);
            $store->role = 'siswa';
            $store->idsiswa = $request->idsiswa;
            $store->save();

            return FormatResponse::send(true, ['record' => $store, 'act' => 'store'], "Registrasi berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function storeGuru(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required',
                'idkelas' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = new $this->table;
            $store->name = $request->name;
            $store->email = $request->email;
            $store->password = bcrypt($request->password);
            $store->role = 'guru';
            $store->idkelas = $request->idkelas;
            $store->save();

            return FormatResponse::send(true, ['record' => $store, 'act' => 'store'], "Registrasi berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'role' => 'required|in:admin,guru,siswa,kepsek',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = $this->table->find($request->id);
            $store->name = $request->name;
            $store->email = $request->email;
            $store->role = $request->role;
            $store->save();

            return FormatResponse::send(true, ['record' => $store, 'act' => 'update'], "Ubah data pengguna berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function updateSiswa(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'idsiswa' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = $this->table->find($request->id);
            $store->name = $request->name;
            $store->email = $request->email;
            $store->idsiswa = $request->idsiswa;
            $store->save();

            return FormatResponse::send(true, ['record' => $store, 'act' => 'update'], "Ubah data pengguna berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function updateGuru(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'idkelas' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $store = $this->table->find($request->id);
            $store->name = $request->name;
            $store->email = $request->email;
            $store->idkelas = $request->idkelas;
            $store->save();

            return FormatResponse::send(true, ['record' => $store, 'act' => 'update'], "Ubah data pengguna berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $destroy = $this->table->findOrFail($request->id);
            $destroy->delete();

            return FormatResponse::send(true, $destroy, "Hapus data pengguna berhasil!", 200);
        } catch (\Throwable $th) {
            return ErrorHandler::record($th, 'response');
        }
    }
}
