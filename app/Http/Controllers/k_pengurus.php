<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\kelas;
use App\Models\User;
use App\Models\kanggota;
use Illuminate\Support\Facades\Hash;

class k_pengurus extends Controller
{
    public function update(Request $request)
    {
        $data = User::findorfail($request->id);
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],
            'no' => ['string', 'max:255'],
            'alamat' => ['string', 'max:255'],
            'jku' => ['string', 'max:255'],
        ]);


        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data->name = $request->nama;
        $data->email = $request->email;
        $data->kode = $request->kode;
        $data->username = $request->username;
        $data->jk = $request->jku;

        $data->save();
        kanggota::updateOrCreate([
            'id_user' => $request->id,

        ], [
            'alamat' => $request->alamat,
            'nohp' => $request->no,
            'kodea' => $request->kode
        ]);
        return 'success';
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],
            'no' => ['string', 'max:255'],
            'alamat' => ['string', 'max:255'],
            'jk' => ['string', 'max:255'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => 1,
            'kode' => $request->kode,
            'username' => $request->username,
            'jk' => $request->jk,
            'status' => 1,
            'password' => Hash::make($request->kode),
            'tanggal_masuk' => date('Y-m-d')
        ]);
        if ($user) {
            kanggota::create([
                'alamat' => $request->alamat,
                'nohp' => $request->no,
                'id_user' => $user->id,
                'kodea' => $request->kode,
                'role' => 1,
                'simpanan' => null,
                'pinjaman' => null
            ]);
            return 'success';
        }
    }
    public function store2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],
            'no' => ['string', 'max:255'],
            'alamat' => ['string', 'max:255'],
            'jk' => ['string', 'max:255'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => 4,
            'kode' => $request->kode,
            'username' => $request->username,
            'jk' => $request->jk,
            'status' => 1,
            'password' => Hash::make($request->kode),
            'tanggal_masuk' => date('Y-m-d')
        ]);
        if ($user) {
            kanggota::create([
                'alamat' => $request->alamat,
                'nohp' => $request->no,
                'id_user' => $user->id,
                'kodea' => $request->kode,
                'role' => 4,
                'simpanan' => null,
                'pinjaman' => null
            ]);
            return 'success';
        }
    }
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(User::with('detail')->where('role', '2')->orWhere('role', '1')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit </button>
                </li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>
               
                </ul>";
                return $btn;
            })->addColumn('namaalamat', function ($data) {
                $btn = $data->detail != null ? $data->detail->alamat : '-';
                return $btn;
            })->addColumn('namatelepon', function ($data) {
                $btn = $data->detail != null ? $data->detail->nohp : '-';
                return $btn;
            })->addColumn('namajk', function ($data) {
                $btn = $data->jk == 1 ? 'Laki - Laki' : 'Perempuan';
                return $btn;
            })->rawColumns(['aksi', 'namalamat', 'namatelepon', 'namajk'])->make(true);
        }
        return view('pengurus.pengurus');
    }
    public function index2()
    {
        if (request()->ajax()) {
            return Datatables::of(User::with('detail')->where('role', '4')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit </button>
                </li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>
               
                </ul>";
                return $btn;
            })->addColumn('namaalamat', function ($data) {
                $btn = $data->detail != null ? $data->detail->alamat : '-';
                return $btn;
            })->addColumn('namatelepon', function ($data) {
                $btn = $data->detail != null ? $data->detail->nohp : '-';
                return $btn;
            })->addColumn('namajk', function ($data) {
                $btn = $data->jk == 1 ? 'Laki - Laki' : 'Perempuan';
                return $btn;
            })->rawColumns(['aksi', 'namalamat', 'namatelepon', 'namajk'])->make(true);
        }
        return view('pengurus.pengawas');
    }
    public function destroy($id)
    {
        $data = User::findorfail($id);
        kanggota::where('id_user', $id)->delete();
        if ($data == null) {
            return 'fail';
        }
        $data->delete();
        return 'success';
    }
}
