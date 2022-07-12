<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\kelas;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $kelas = kelas::with('namaketi')->get();

        return view('auth.register', compact('kelas'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'prodi' => ['required', 'string', 'max:255'],

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
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'ps' => $request->prodi
        ]);
        $idkls = kelas::where('id', $request->kelas)->first();
        if ($idkls->id_keti == null) {
            $idkls->id_keti = $request->nim;
        }
        $idkls->save();
        $user->assignRole('mahasiswa');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
