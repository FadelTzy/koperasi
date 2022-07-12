<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\ksimpanan;
use App\Models\ktSimpan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KsimpananController extends Controller
{
    public function lsimpan()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        if (request()->ajax()) {
            return Datatables::of(ktSimpan::with('datauser')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'> ";
                if ($data->status == '1') {
                } else {
                    $btn .= "<li class='list-inline-item'>
                    <button type='button'  onclick='staffterima(" . $data->id . ")'   class='btn btn-success btn-sm btn-xs mb-1'>Terima </button>
                    </li>";
                }
                $btn .= "<li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
                $btn .= "</ul>";
                return $btn;
            })->addColumn('np', function ($data) {
                $btn =  $data->datauser->kode . ' - ' . $data->datauser->name;
                return $btn;
            })->addColumn('status_pe', function ($data) {
                if ($data->status == 1) {
                    $btn = "Disetujui";
                } else {
                    $btn = "Diajukan";
                }
                return $btn;
            })->rawColumns(['aksi',  'np', 'status_pe'])->make(true);
        }
        return view('pengurus.pengajuansimpanan2', compact('date'));
    }
    public function csimpan()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = Datatables::of(ktSimpan::with('datauser')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
            $dataj = json_encode($data);

            $btn = "      <ul class='list-inline mb-0'> ";
            if ($data->status == '1') {
            } else {
                $btn .= "<li class='list-inline-item'>
                    <button type='button'  onclick='staffterima(" . $data->id . ")'   class='btn btn-success btn-sm btn-xs mb-1'>Terima </button>
                    </li>";
            }
            $btn .= "<li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
            $btn .= "</ul>";
            return $btn;
        })->addColumn('np', function ($data) {
            $btn =  $data->datauser->kode . ' - ' . $data->datauser->name;
            return $btn;
        })->addColumn('status_pe', function ($data) {
            if ($data->status == 1) {
                $btn = "Disetujui";
            } else {
                $btn = "Diajukan";
            }
            return $btn;
        })->rawColumns(['aksi',  'np', 'status_pe'])->make(true);

        return view('pdf.cetaksimpan', compact('data', 'date'));
    }
    public function cetak($id)
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $user = User::where('id', $id)->first();
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $monitoring = ktSimpan::where('id_user', $id)->where('status', 1)->get();
        return view('pdf.datasimpanan', compact('monitoring', 'user', 'date'));
    }
    public function as()
    {
        $id = Auth::user()->id;
        $dataa = User::where('id', $id)->first();
        if (request()->ajax()) {
            return Datatables::of(ktSimpan::where('id_user', $id)->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
          
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>     
                </ul>";
                # code...
                if ($data->status == 2) {

                    return $btn;
                }
                return '-';
            })->addColumn('total', function ($data) {
                $btn = 'Rp. ' . $data->total_simpanan;
                return $btn;
            })->addColumn('status_pe', function ($data) {
                if ($data->status == 2) {
                    $btn = 'Diajukan';
                } else {
                    $btn  = 'Diterima';
                }
                return $btn;
            })->rawColumns(['aksi', 'status_pe', 'total'])->make(true);
        }
        $ds = ksimpanan::all();
        return view('anggota.simpanan', compact('dataa', 'ds'));
    }
    public function sa($id)
    {
        $dataa = User::where('id', $id)->first();
        if (request()->ajax()) {
            return Datatables::of(ktSimpan::where('id_user', $id)->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
          
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>     
                </ul>";
                if (Auth::user()->role == 1 || Auth::user()->role == 2) {
                    # code...
                    return $btn;
                } else {
                    return '-';
                }
            })->addColumn('total', function ($data) {
                $btn = 'Rp. ' . $data->total_simpanan;
                return $btn;
            })->addColumn('status_pe', function ($data) {
                if ($data->status == 2) {
                    $btn = 'Diajukan';
                } else {
                    $btn  = 'Diterima';
                }
                return $btn;
            })->rawColumns(['aksi', 'status_pe', 'total'])->make(true);
        }
        $ds = ksimpanan::all();
        return view('pengurus.simpanananggota', compact('dataa', 'ds'));
    }
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(ksimpanan::get())->addIndexColumn()->addColumn('aksi', function ($data) {
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
            })->addColumn('total', function ($data) {
                $btn = 'Rp. ' . $data->jumlah;
                return $btn;
            })->rawColumns(['aksi', 'total'])->make(true);
        }
        return view('pengurus.datasimpanan');
    }
    public function update(Request $request)
    {
        $data = ksimpanan::findorfail($request->id);
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'jumlah' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data->nama = $request->nama;
        $data->jumlah = $request->jumlah;
        $data->kode = $request->kode;
        $data->save();

        return 'success';
    }
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'jumlah' => ['required', 'string', 'max:255'],
            'id' => ['required', 'string', 'max:255'],


        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $u = User::where('id', $request->id)->first();
        $kode = 'S' . $u->kode . date("dmY");
        $user = ktSimpan::create([
            'kode_simpan' => $kode,
            'nama_simpanan' => $request->nama,
            'total_simpanan' => $request->jumlah,
            'id_simpan' => $request->jenis,
            'id_user' => $request->id,
            'status' => 2,
            'tanggal' => date("d-m-Y", strtotime($request->tanggal)),

        ]);
        if ($user) {

            return 'success';
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'jumlah' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],


        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $user = ksimpanan::create([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'kode' => $request->kode,

        ]);
        if ($user) {

            return 'success';
        }
    }
    public function destroy($id)
    {
        $data = ksimpanan::findorfail($id);
        if ($data == null) {
            return 'fail';
        }
        $data->delete();
        return 'success';
    }
    public function destroysimpan($id)
    {
        $data = ktSimpan::findorfail($id);
        if ($data == null) {
            return 'fail';
        }
        $data->delete();
        return 'success';
    }
}
