<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\kpinjaman;
use App\Models\ktPinjam;
use Illuminate\Support\Carbon;
use App\Models\ktAngsuran;

class KpinjamanController extends Controller
{
    public function cpinjam()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = Datatables::of(ktPinjam::with('datauser')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
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

        return view('pdf.cetakpinjam', compact('date', 'data'));
    }
    public function lpinjam()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        if (request()->ajax()) {
            return Datatables::of(ktPinjam::with('datauser')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
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
        return view('pengurus.pengajuanpinjaman2', compact('date'));
    }
    public function editpinjam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maksimal' => ['required', 'string', 'max:255'],
            'id' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $user = ktPinjam::where('id', $request->id)->update([
            'jumlah_pinjam' => $request->maksimal,
            'biaya_angsuran_pokok' => $request->angsuranpokok,
            'biaya_angsuran_bunga' => $request->angsuranbunga,
            'tanggal' => date("d-m-Y"),
        ]);
        if ($user) {

            return 'success';
        }
    }
    public function pinjam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => ['required', 'string', 'max:255'],
            'pinjaman' => ['required', 'string', 'max:255'],
            'nama_pinjam' => ['required', 'string', 'max:255'],
            'id' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $uk = User::where('id', $request->id)->first();
        $kode = 'P' . $uk->kode . date("dmY");
        $user = ktPinjam::create([
            'kode_pinjam' => $kode,
            'id_pinjam' => $request->jenis,
            'nama_pinjam' => $request->nama_pinjam,
            'jumlah_pinjam' => $request->pinjaman,
            'jatuh_tempo' =>  date("d-m-Y"),
            'lama_angsuran' => $request->angsur,
            'bunga' => $request->bunga,
            'biaya_angsuran_pokok' => $request->angsuranpokok,
            'biaya_angsuran_bunga' => $request->angsuranbunga,
            'tanggal_diterima' => null,
            'id_user' => $request->id,
            'status' => 2,
            'status_pinjam' => 2,
            'tanggal' => date("d-m-Y"),

        ]);
        if ($user) {

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
                if ($data->status == '1') {
                    $btn .= "<li class='list-inline-item'>
                    <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-success btn-xs mb-1'>Angsur </button>
                    </li>";
                } else {
                    $btn .= "<li class='list-inline-item'>
                    <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Edit </button>
                    </li>";
                }
                $btn .= "<li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
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
        return view('pengurus.angsuranpinjaman', compact('data', 'k', 'total', 'user', 'date'));
    }
    public function cetak($id)
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $user = User::where('id', $id)->first();


        $datapinjam = Datatables::of(ktPinjam::where(function ($q) use ($id) {
            $q->where('id_user', $id);
        })->get())->addIndexColumn()->addColumn('aksi', function ($data) {
            $dataj = json_encode($data);

            $btn = "      <ul class='list-inline mb-0'> ";
            if ($data->status == '1') {
                $btn .= "<li class='list-inline-item'>
                    <a type='button'  href='" . url('/admin/data-pinjaman/') . '/' . $data->id_user .  '/' . 'angsuran/' . $data->id  . "'  class='btn btn-sm btn-success btn-xs mb-1'>Angsur </a>
                    </li>";
            } else {
                $btn .= "<li class='list-inline-item'>
                    <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Edit </button>
                    </li>";
            }
            $btn .= "<li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
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

        return view('pdf.datapinjaman', compact('user', 'date', 'datapinjam'));
    }
    public function pa($id)
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $date  = Carbon::now()->isoFormat('D MMMM Y');
        $data = kpinjaman::all();
        $user = User::where('id', $id)->first();
        $d = ktPinjam::where('id_user', $id)->where('status_pinjam', 2)->get();

        if (request()->ajax()) {
            return Datatables::of(ktPinjam::where(function ($q) use ($id) {
                $q->where('id_user', $id);
            })->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'> ";
                if ($data->status == '1') {
                    $btn .= "<li class='list-inline-item'>
                    <a type='button'  href='" . url('/admin/data-pinjaman/') . '/' . $data->id_user .  '/' . 'angsuran/' . $data->id  . "'  class='btn btn-sm btn-success btn-xs mb-1'>Angsur </a>
                    </li>";
                } else {
                    $btn .= "<li class='list-inline-item'>
                    <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Edit </button>
                    </li>";
                }
                $btn .= "<li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                    </li>";
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
        return view('pengurus.pinjamananggota', compact('d', 'data', 'user', 'date'));
    }
    public function ap()
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
            })->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'> ";
                if ($data->status == '1') {
                    $btn .= '-';
                } else {
                    $btn .= "<li class='list-inline-item'>
                    <button type='button' data-toggle='modal' onclick='staffupd(" . $dataj . ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Edit </button>
                    </li>";
                    $btn .= "<li class='list-inline-item'>
                        <button type='button'  onclick='staffdel(" . $data->id . ")'   class='btn btn-danger btn-sm btn-xs mb-1'>Hapus </button>
                        </li>";
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
        return view('anggota.pinjaman', compact('d', 'data', 'user', 'date'));
    }
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(kpinjaman::get())->addIndexColumn()->addColumn('aksi', function ($data) {
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
                $btn = 'Rp. ' . $data->maksimal;
                return $btn;
            })->addColumn('angsuran', function ($data) {
                $btn =  $data->angsur . ' Bulan';
                return $btn;
            })->addColumn('bungaa', function ($data) {
                $btn =  $data->bunga . ' %' . ' / Tahun';
                return $btn;
            })->rawColumns(['aksi', 'angsuran', 'bungaa', 'total'])->make(true);
        }
        return view('pengurus.datapinjaman');
    }
    public function update(Request $request)
    {
        $data = kpinjaman::findorfail($request->id);
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'maksimal' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],

            'angsur' => ['required', 'string', 'max:255'],
            'bunga' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data->nama = $request->nama;
        $data->maksimal = $request->maksimal;
        $data->kode = $request->kode;
        $data->bunga = $request->bunga;
        $data->angsur = $request->angsur;

        $data->save();

        return 'success';
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'maksimal' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'string', 'max:255'],

            'angsur' => ['required', 'string', 'max:255'],
            'bunga' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $user = kpinjaman::create([
            'nama' => $request->nama,
            'maksimal' => $request->maksimal,
            'kode' => $request->kode,
            'angsur' => $request->angsur,
            'bunga' => $request->bunga,

        ]);
        if ($user) {

            return 'success';
        }
    }
    public function deletepinjam($id)
    {
        $data = ktPinjam::findorfail($id);
        if ($data == null) {
            return 'fail';
        }
        $data->delete();
        return 'success';
    }
    public function destroy($id)
    {
        $data = kpinjaman::findorfail($id);
        if ($data == null) {
            return 'fail';
        }
        $data->delete();
        return 'success';
    }
}
