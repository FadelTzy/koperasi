<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\kanggota;
use App\Models\ksimpanan;
use Illuminate\Support\Facades\Hash;
use App\Models\ktSimpan;
use Illuminate\Support\Carbon;

class k_anggota extends Controller
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
            'kodea' => $request->kode,
            'pekerjaan' => $request->pekerjaan
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
            'role' => 3,
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
                'pekerjaan' => $request->pekerjaan,
                'simpanan' =>  $request->pokok,
                'pinjaman' => 0,
                'role' => 3,

            ]);
            $kodes = 'SP' . date('mYHi');
            ktSimpan::create([
                'kode_simpan' => $kodes,
                'id_user' => $user->id,
                'total_simpanan' => $request->pokok,
                'tanggal' => date('Y-m-d'),
                'nama_simpanan' => 'Pokok',
                'id_simpan' => 1,
                'status' => 1
            ]);
            return 'success';
        }
    }
    public function index()
    {
        $dp = ksimpanan::where('kode', 'S01')->first();
        if (request()->ajax()) {
            return Datatables::of(User::with('detail')->where('role', '3')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit </button>
                </li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
                if ($data->status == 1) {
                    $btn .= "
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffkel(" . $data->id . ")'   class='btn btn-warning btn-sm btn-xs mb-1'>Keluar </button>
                    </li>";
                } else {
                    $btn .= "
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffaktif(" . $data->id . ")'   class='btn btn-primary btn-sm btn-xs mb-1'>Aktif </button>
                    </li>";
                }

                $btn .= "</ul>";
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
            })->addColumn('statuss', function ($data) {
                $btn = $data->status == 1 ? 'Aktif' : 'Keluar';
                return $btn;
            })->rawColumns(['aksi', 'namalamat', 'namatelepon', 'namajk'])->make(true);
        }
        return view('pengurus.anggota', compact('dp'));
    }
    public function anggota()
    {
        if (request()->ajax()) {
            return Datatables::of(User::with('detail')->where('role', '3')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit </button>
                </li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
                if ($data->status == 1) {
                    $btn .= "
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffkel(" . $data->id . ")'   class='btn btn-warning btn-sm btn-xs mb-1'>Keluar </button>
                    </li>";
                } else {
                    $btn .= "
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffaktif(" . $data->id . ")'   class='btn btn-primary btn-sm btn-xs mb-1'>Aktif </button>
                    </li>";
                }

                $btn .= "</ul>";
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
            })->addColumn('statuss', function ($data) {
                $btn = $data->status == 1 ? 'Aktif' : 'Keluar';
                return $btn;
            })->addColumn('pekerjaann', function ($data) {
                $btn = $data->detail != null ? $data->detail->pekerjaan : '-';
                return $btn;
            })->rawColumns(['aksi', 'pekerjaann', 'namalamat', 'namatelepon', 'namajk'])->make(true);
        }
        return view('pengurus.cetakanggota');
    }
    public function anggotac()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = Datatables::of(User::with('detail')->where('role', '3')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
            $dataj = json_encode($data);

            $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit </button>
                </li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
            if ($data->status == 1) {
                $btn .= "
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffkel(" . $data->id . ")'   class='btn btn-warning btn-sm btn-xs mb-1'>Keluar </button>
                    </li>";
            } else {
                $btn .= "
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffaktif(" . $data->id . ")'   class='btn btn-primary btn-sm btn-xs mb-1'>Aktif </button>
                    </li>";
            }

            $btn .= "</ul>";
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
        })->addColumn('statuss', function ($data) {
            $btn = $data->status == 1 ? 'Aktif' : 'Keluar';
            return $btn;
        })->addColumn('pekerjaann', function ($data) {
            $btn = $data->detail != null ? $data->detail->pekerjaan : '-';
            return $btn;
        })->rawColumns(['aksi', 'pekerjaann', 'namalamat', 'namatelepon', 'namajk'])->make(true);

        return view('pdf.cetakanggota', compact('data', 'date'));
    }
    public function tabungan()
    {
        $dp = ksimpanan::where('kode', 'S01')->first();
        if (request()->ajax()) {
            return Datatables::of(User::with('detail')->where('role', '3')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <a type='button' href='" . url('admin/tabungan/penarikan') . '/' . $data->id . "'  class='btn btn-sm btn-success btn-xs mb-1'>Riwayat Penarikan </a>
                </li>
                   ";


                $btn .= "</ul>";
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
            })->addColumn('statuss', function ($data) {
                $btn = $data->status == 1 ? 'Aktif' : 'Keluar';
                return $btn;
            })->addColumn('tabungan', function ($data) {
                $btn = $data->detail->simpanan;
                return $btn;
            })->rawColumns(['aksi', 'namalamat', 'tabungan', 'namatelepon', 'namajk'])->make(true);
        }
        return view('pengurus.tabungan', compact('dp'));
    }
    public function cetaktabungan()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = Datatables::of(User::with('detail')->where('role', '3')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
            $dataj = json_encode($data);

            $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-success btn-xs mb-1'>Riwayat Penarikan </button>
                </li>
                   ";


            $btn .= "</ul>";
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
        })->addColumn('statuss', function ($data) {
            $btn = $data->status == 1 ? 'Aktif' : 'Keluar';
            return $btn;
        })->addColumn('tabungan', function ($data) {
            $btn = $data->detail->simpanan;
            return $btn;
        })->rawColumns(['aksi', 'namalamat', 'tabungan', 'namatelepon', 'namajk'])->make(true);

        return view('pdf.datatabungan', compact('data', 'date'));
    }
    public function transaksi()
    {
        if (request()->ajax()) {
            return Datatables::of(User::with('detail')->where('role', '3')->where('status', 1)->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <a type='button'  href='" . url('/admin/data-simpanan/') . '/' . $data->id . "'   class='btn btn-sm btn-success btn-xs mb-1'>Simpanan </a>
                </li>
                    <li class='list-inline-item'>
                    <a type='button'   href='" . url('/admin/data-pinjaman/') . '/' . $data->id . "'   class='btn btn-danger btn-sm btn-xs mb-1'>Pinjaman </a>
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
            })->addColumn('statuss', function ($data) {
                $btn = $data->status == 1 ? 'Aktif' : 'Keluar';
                return $btn;
            })->rawColumns(['aksi', 'namalamat', 'namatelepon', 'namajk'])->make(true);
        }
        return view('pengurus.transaksi');
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
    public function keluar($id)
    {
        $data = User::findorfail($id);

        if ($data == null) {
            return 'fail';
        }
        $data->status = 2;
        $data->save();
        return 'success';
    }
    public function aktif($id)
    {
        $data = User::findorfail($id);

        if ($data == null) {
            return 'fail';
        }
        $data->status = 1;
        $data->save();
        return 'success';
    }
}
