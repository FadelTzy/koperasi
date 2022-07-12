<?php

namespace App\Http\Controllers;

use App\Models\kanggota;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\ktPinjam;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        if (Auth::user()->role == 3) {
            $angsur = ktPinjam::join('kt_angsurans', 'kt_angsurans.id_pinjaman', '=', 'kt_pinjams.id')->where('kt_pinjams.status_pinjam', 2)->where('kt_angsurans.id_user', Auth::user()->id)->sum('kt_angsurans.pokok');
            $simpan = kanggota::select('simpanan')->where('role', 3)->where('id_user', Auth::user()->id)->sum('simpanan');
            $pinjam = kanggota::select('pinjaman')->where('role', 3)->where('id_user', Auth::user()->id)->sum('pinjaman');
        } else {


            $angsur = ktPinjam::join('kt_angsurans', 'kt_angsurans.id_pinjaman', '=', 'kt_pinjams.id')->where('kt_pinjams.status_pinjam', 2)->sum('kt_angsurans.pokok');
            $simpan = kanggota::select('simpanan')->where('role', 3)->sum('simpanan');
            $pinjam = kanggota::select('pinjaman')->where('role', 3)->sum('pinjaman');
        }
        $datau = user::where('role', 3)->where('status', 1)->count();
        return view('admin.dashboard', compact('datau', 'simpan', 'pinjam', 'angsur'));
    }
    public function index2()
    {
        return view('admin.ds');
    }
    public function profile()
    {
        return view('admin.profil');
    }
    public function profilstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['string', 'max:255'],
            'alamat' => ['max:255'],
            'no' => ['max:255'],
            'email' => ['string', 'max:255'],
            'password' => ['max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::where('id', Auth::user()->id)->first();

        $data->name = $request->nama;
        $data->username = $request->username;


        if (Auth::user()->role == 3) {
            kanggota::where('id_user', Auth::user()->id)->update([
                'nohp' => $request->no,
                'alamat' => $request->alamat
            ]);
        }
        $data->email = $request->email;
        if ($request->password != '' || $request->password != null) {
            $data->password =  Hash::make($request->password);
        }
        $data->save();

        return 'success';
    }
}
