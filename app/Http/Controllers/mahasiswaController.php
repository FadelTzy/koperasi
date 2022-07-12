<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\kelas;
use Illuminate\Support\Facades\Hash;

class mahasiswaController extends Controller
{
    public function update(Request $request)
    {
        $data = User::findorfail($request->id);
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'pg' => ['required', 'string', 'max:255'],

            'nim' => ['string', 'max:255', 'required'],
            'no' => ['string', 'max:255'],
            'angkatan' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);


        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }


        $data->name = $request->nama;
        $data->angkatan = $request->angkatan;
        $data->no = $request->no;
        $data->email = $request->email;
        $data->username = $request->nim;
        $data->no_identitas = $request->nim;
        $data->ps = $request->pg;


        $data->save();

        return 'success';
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'pg' => ['required', 'string', 'max:255'],

            'nim' => ['string', 'max:255', 'required'],
            'no' => ['string', 'max:255'],
            'angkatan' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $user = User::create([
            'name' => $request->nama,
            'no' => $request->no,
            'no_identitas' => $request->nim,
            'username' => $request->nim,
            'role' => 2,
            'angkatan' => $request->angkatan,
            'password' => Hash::make('unm' . $request->angkatan),
            'email' => $request->email,
            'ps' => $request->pg
        ]);
        $user->assignRole('mahasiswa');
        if ($user) {
            return 'success';
        }
    }
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(User::role('mahasiswa')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
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
            })->rawColumns(['aksi'])->make(true);
        }

        return view('admin.mahasiswa');
    }
    public function destroy($id)
    {
        $data = User::findorfail($id);
        if ($data == null) {
            return 'fail';
        }
        $data->delete();
        return 'success';
    }
}
