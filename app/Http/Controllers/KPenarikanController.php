<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\kanggota;
use App\Models\kPenarikan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KPenarikanController extends Controller
{
    public function ape()
    {
        $id = Auth::user()->id;
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $dataa = User::where('id', $id)->first();
        $detail = kanggota::where('id_user', $id)->first();
        if (request()->ajax()) {
            return Datatables::of(kPenarikan::where('id_user', $id)->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>";
                if (Auth::user()->role == 1 && Auth::user()->role == 2) {
                    if ($data->status == 2) {
                        $btn .= "<li class='list-inline-item'>
                        <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                        </li>";       # code...
                    }
                } else {
                    $btn .= '-';
                }


                $btn .= "</ul>";
                return $btn;
            })->addColumn('status_pe', function ($data) {
                if ($data->status == 2) {
                    $btn = 'Diajukan';
                } else {
                    $btn  = 'Diterima';
                }
                return $btn;
            })->rawColumns(['aksi', 'status_pe'])->make(true);
        }
        return view('anggota.penarikan', compact('dataa', 'date', 'detail'));
    }
    public function s($id)
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $dataa = User::where('id', $id)->first();
        $detail = kanggota::where('id_user', $id)->first();
        if (request()->ajax()) {
            return Datatables::of(kPenarikan::where('id_user', $id)->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>";
                if (Auth::user()->role == 1 && Auth::user()->role == 2) {
                    if ($data->status == 2) {
                        $btn .= "<li class='list-inline-item'>
                        <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                        </li>";       # code...
                    }
                } else {
                    $btn .= '-';
                }


                $btn .= "</ul>";
                return $btn;
            })->addColumn('status_pe', function ($data) {
                if ($data->status == 2) {
                    $btn = 'Diajukan';
                } else {
                    $btn  = 'Diterima';
                }
                return $btn;
            })->rawColumns(['aksi', 'status_pe'])->make(true);
        }
        return view('pengurus.penarikan', compact('dataa', 'date', 'detail'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'simpanan' => ['required', 'string', 'max:255'],
            'penarikan' => ['required', 'string', 'max:255'],
            'id' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $kode = 'PN' . date("mYHs");
        $user = kPenarikan::create([
            'id_user' => $request->id,
            'tanggal' => date("d-m-Y"),
            'kode' => $kode,
            'tabungan' => $request->simpanan,
            'jumlah' => $request->penarikan,
            'sisa' => intval($request->simpanan) - intval($request->penarikan),
            'status' => 2
        ]);
        if ($user) {
            return 'success';
        }
    }
    public function destroy($id)
    {
        $data = kPenarikan::findorfail($id);
        if ($data == null) {
            return 'fail';
        }
        $data->delete();
        return 'success';
    }
}
