<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\kelas;
use App\Models\User;
use App\Models\kanggota;
use Illuminate\Support\Facades\Hash;
use App\Models\kpinjaman;
use App\Models\ktPinjam;
use Illuminate\Support\Carbon;
use App\Models\ktAngsuran;
use Illuminate\Support\Facades\Auth;

class KtAngsuranController extends Controller
{
    public function asu()
    {
        $id = Auth::user()->id;
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = kpinjaman::all();
        $user = User::where('id', $id)->first();
        $d = ktPinjam::where('id_user', $id)->where('status_pinjam', 2)->get();

        if (request()->ajax()) {
            return Datatables::of(ktPinjam::where(function ($q) use ($id) {
                $q->where('id_user', $id);
                $q->where('status', 1);
            })->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'> ";
                if ($data->status == '1') {
                    $btn .= "<li class='list-inline-item'>
                    <a type='button'  href='" . url('/admin/data-pinjaman/') . '/' . $data->id_user .  '/' . 'angsuran/' . $data->id  . "'  class='btn btn-sm btn-success btn-xs mb-1'>Angsur </a>
                    </li>";
                } else {
                }
                $btn .= "</ul>";
                return $btn;
            })->addColumn('total', function ($data) {
                $btn = 'Pokok :  ' . $data->biaya_angsuran_pokok . '<br>' . 'Bunga :  ' . $data->biaya_angsuran_bunga;
                return $btn;
            })->addColumn('angsuran', function ($data) {
                $btn =  $data->lama_angsuran . ' Bulan';
                return $btn;
            })->addColumn('bungaa', function ($data) {
                $btn =  $data->bunga . ' %';
                return $btn;
            })->addColumn('status_pe', function ($data) {
                if ($data->status == 1) {
                    $btn = "Disetujui";
                } else {
                    $btn = "Diajukan";
                }
                return $btn;
            })->addColumn('status_pi', function ($data) {
                if ($data->status_pinjam == 1) {
                    $btn = "Lunas";
                } else {
                    $btn = "Belum Lunas";
                }
                return $btn;
            })->rawColumns(['aksi', 'angsuran', 'bungaa', 'total', 'status_pi', 'status_pe'])->make(true);
        }
        return view('anggota.angsuran', compact('d', 'data', 'user', 'date'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255'],
            'idp' => ['required', 'string', 'max:255'],
            'angsur' => ['required', 'string', 'max:255'],
            'pokok' => ['required', 'string', 'max:255'],
            'bunga' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $user = ktAngsuran::create([
            'id_user' => $request->id,
            'id_pinjaman' => $request->idp,
            'tanggal' => date("d-m-Y"),
            'angsuran' => $request->angsur,
            'bunga' => $request->bunga,
            'pokok' => $request->pokok,
            'status' => 1,
        ]);
        if ($user) {
            $cek = ktAngsuran::where(function ($q) use ($request) {
                $q->where('id_user', $request->id);
                $q->where('id_pinjaman', $request->idp);
            })->count();
            if ($cek == $request->tenor) {
                ktPinjam::where('id', $request->idp)->update(['status_pinjam' => 1]);
                kanggota::where('id_user', $request->id)->update(['pinjaman' => 0]);
                return 'succeed';
            }
            return 'success';
        }
    }
    public function angsur($id, $idp)
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = kpinjaman::all();
        $k = ktPinjam::where('id', $idp)->first();
        $user = User::where('id', $id)->first();
        $total = ktAngsuran::with('datapinjaman')->where(function ($q) use ($id, $idp) {
            $q->where('id_user', $id);
            $q->where('id_pinjaman', $idp);
        })->count();
        if (request()->ajax()) {
            return Datatables::of(ktAngsuran::with('datapinjaman')->where(function ($q) use ($id, $idp) {
                $q->where('id_user', $id);
                $q->where('id_pinjaman', $idp);
            })->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'> ";

                $btn .= "<li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
                $btn .= "</ul>";
                return $btn;
            })->addColumn('njumlah_pinjam', function ($data) {
                $btn = $data->datapinjaman->jumlah_pinjam;
                return $btn;
            })->addColumn('tenor', function ($data) {
                $btn = $data->datapinjaman->lama_angsuran;
                return $btn;
            })->addColumn('nkode_pinjam', function ($data) {
                $btn = $data->datapinjaman->kode_pinjam;
                return $btn;
            })->addColumn('biaya', function ($data) {
                $btn = 'Pokok :' . $data->datapinjaman->biaya_angsuran_pokok . '<br>';
                $btn .= 'Bunga :' . $data->datapinjaman->biaya_angsuran_bunga;
                return $btn;
            })->rawColumns(['aksi', 'biaya', 'nkode_pinjam', 'tenor', 'biaya', 'njumlah_pinjam', 'total'])->make(true);
        }
        return view('pengurus.angsuranpinjaman', compact('data', 'k', 'total', 'user', 'date'));
    }
}
