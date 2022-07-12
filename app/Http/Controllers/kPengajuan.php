<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\kPenarikan;
use App\Models\kanggota;
use App\Models\kpinjaman;
use App\Models\ktPinjam;
use App\Models\ktSimpan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class kPengajuan extends Controller
{
    public function terimas($id)
    {
        $data = ktSimpan::findorfail($id);
        $u = kanggota::where('id_user', $data->id_user)->first();
        $u->simpanan = $u->simpanan  + $data->total_simpanan;
        $u->save();
        $data->status = 1;

        if ($data == null) {
            return 'fail';
        }
        $data->save();
        return 'success';
    }
    public function terima($id)
    {
        $data = ktPinjam::findorfail($id);
        $u = kanggota::where('id_user', $data->id_user)->first();
        $u->pinjaman = $u->pinjaman + $data->jumlah_pinjam;
        $u->save();
        $data->status = 1;

        if ($data == null) {
            return 'fail';
        }
        $data->save();
        return 'success';
    }
    public function terimat($id)
    {
        $data = kPenarikan::findorfail($id);
        $u = kanggota::where('id_user', $data->id_user)->first();
        $u->simpanan = $u->simpanan - $data->jumlah;
        $u->save();
        $data->status = 1;

        if ($data == null) {
            return 'fail';
        }
        $data->save();
        return 'success';
    }
    public function pinjam()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = kpinjaman::all();
        if (request()->ajax()) {
            return Datatables::of(ktPinjam::with('datauser')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'> ";
                if (Auth::user()->role == 1 || Auth::user()->role == 2) {
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
                } else {
                    $btn .= '-';
                }
            })->addColumn('total', function ($data) {
                $btn = 'Pokok :  ' . $data->biaya_angsuran_pokok . '<br>' . 'Bunga :  ' . $data->biaya_angsuran_bunga;
                return $btn;
            })->addColumn('angsuran', function ($data) {
                $btn =  $data->lama_angsuran . ' Bulan';
                return $btn;
            })->addColumn('bungaa', function ($data) {
                $btn =  $data->bunga . ' %';
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
            })->addColumn('status_pi', function ($data) {
                if ($data->status_pinjam == 1) {
                    $btn = "Lunas";
                } else {
                    $btn = "Belum Lunas";
                }
                return $btn;
            })->rawColumns(['aksi', 'angsuran', 'bungaa', 'total', 'np', 'status_pi', 'status_pe'])->make(true);
        }
        return view('pengurus.pengajuanpinjaman', compact('data', 'date'));
    }
    public function simpan()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = kpinjaman::all();
        if (request()->ajax()) {
            return Datatables::of(ktSimpan::with('datauser')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'> ";
                if (Auth::user()->role == 1 || Auth::user()->role == 2) {
                    # code...
                    if ($data->status == '1') {
                    } else {
                        $btn .= "<li class='list-inline-item'>
                        <button type='button'  onclick='staffterima(" . $data->id . ")'   class='btn btn-success btn-sm btn-xs mb-1'>Terima </button>
                        </li>";
                    }
                    $btn .= "<li class='list-inline-item'>
                        <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                        </li>";
                } else {
                    $btn .= '-';
                }
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
        return view('pengurus.pengajuansimpanan', compact('data', 'date'));
    }
    public function tarik()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        if (request()->ajax()) {
            return Datatables::of(kPenarikan::with('datauser')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'> ";
                if (Auth::user()->role == 1 || Auth::user()->role == 2) {
                    if ($data->status == '1') {
                    } else {
                        $btn .= "<li class='list-inline-item'>
                        <button type='button'  onclick='staffterima(" . $data->id . ")'   class='btn btn-success btn-sm btn-xs mb-1'>Terima </button>
                        </li>";
                    }
                    $btn .= "<li class='list-inline-item'>
                        <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                        </li>";
                } else {
                    $btn .= '-';
                }

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
        return view('pengurus.pengajuanpenarikan', compact('date'));
    }
}
