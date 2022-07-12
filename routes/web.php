<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\adminController;

use App\Http\Controllers\k_pengurus;
use App\Http\Controllers\k_anggota;
use App\Http\Controllers\KsimpananController;
use App\Http\Controllers\KpinjamanController;
use App\Http\Controllers\kPengajuan;
use App\Http\Controllers\KtAngsuranController;
use App\Http\Controllers\KPenarikanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [Controller::class, 'index'])->name('index');
    Route::group(['prefix' => 'anggota'], function () {
        Route::get('/data-simpanan', [KsimpananController::class, 'as'])->name('anggota.simpanan');
        Route::get('/data-pinjaman', [KpinjamanController::class, 'ap'])->name('anggota.pinjaman');
        Route::get('/data-angsuran', [KtAngsuranController::class, 'asu'])->name('anggota.angsuran');
        Route::get('/data-penarikan', [KPenarikanController::class, 'ape'])->name('anggota.penarikan');
    });
    Route::group(['prefix' => 'admin'], function () {
        //penarikan
        Route::get('/tabungan/penarikan/{id}', [KPenarikanController::class, 's']);
        Route::post('/tabungan/penarikan/', [KPenarikanController::class, 'store'])->name('penarikan.store');;
        Route::delete('/tabungan/penarikan/{id}', [KPenarikanController::class, 'destroy']);

        Route::get('/transaksi', [k_anggota::class, 'transaksi'])->name('transaksi.index');
        Route::get('/tabungan', [k_anggota::class, 'tabungan'])->name('tabungan.index');
        Route::get('/tabungan/cetak', [k_anggota::class, 'cetaktabungan']);

        //pengurus
        Route::get('/data-pengurus', [k_pengurus::class, 'index'])->name('pengurus.index');
        Route::post('/pengurus', [k_pengurus::class, 'store'])->name('pengurus.store');
        Route::delete('/pengurus/{id}', [k_pengurus::class, 'destroy'])->name('pengurus.destroy');
        Route::post('/pengurus/edit', [k_pengurus::class, 'update'])->name('pengurus.update');
        //pengawas
        Route::get('/data-pengawas', [k_pengurus::class, 'index2'])->name('pengawas.index');
        Route::post('/pengawas', [k_pengurus::class, 'store2'])->name('pengawas.store');
        //anggota laporan
        Route::get('/data-anggota', [k_anggota::class, 'index'])->name('anggota.index');
        Route::get('/laporan-anggota', [k_anggota::class, 'anggota'])->name('cetakanggota.index');
        Route::get('/laporan-anggota/cetak', [k_anggota::class, 'anggotac'])->name('ac.index');
        Route::get('/laporan-simpanan', [KsimpananController::class, 'lsimpan'])->name('cetaksimpan.index');
        Route::get('/laporan-simpanan/cetak', [KsimpananController::class, 'csimpan'])->name('cs.index');
        Route::get('/laporan-pinjaman', [KpinjamanController::class, 'lpinjam'])->name('cetakpinjam.index');
        Route::get('/laporan-pinjaman/cetak', [KpinjamanController::class, 'cpinjam'])->name('cp.index');

        Route::post('/anggota', [k_anggota::class, 'store'])->name('anggota.store');
        Route::delete('/anggota/{id}', [k_anggota::class, 'destroy'])->name('anggota.destroy');
        Route::delete('/anggota/keluar/{id}', [k_anggota::class, 'keluar'])->name('keluar.destroy');
        Route::delete('/anggota/aktif/{id}', [k_anggota::class, 'aktif'])->name('aktif.destroy');
        Route::post('/anggota/edit', [k_anggota::class, 'update'])->name('anggota.update');
        //simpanan
        Route::get('/data-simpanan', [KsimpananController::class, 'index'])->name('simpanan.index');
        Route::get('/data-simpanan/{id}', [KsimpananController::class, 'sa'])->name('sa.index');
        Route::post('/data-simpanan', [KsimpananController::class, 'simpan'])->name('sa.store');
        Route::delete('/data-simpanan/{id}/des', [KsimpananController::class, 'destroysimpan'])->name('sa.destroy');

        Route::get('/data-simpanan/cetak/{id}', [KsimpananController::class, 'cetak'])->name('cetak.index');

        Route::post('/simpanan', [KsimpananController::class, 'store'])->name('simpanan.store');
        Route::delete('/simpanan/{id}', [KsimpananController::class, 'destroy'])->name('simpanan.destroy');
        Route::post('/simpanan/edit', [KsimpananController::class, 'update'])->name('simpanan.update');
        //simpanan
        Route::get('/data-pinjaman', [KpinjamanController::class, 'index'])->name('pinjaman.index');
        Route::get('/data-pinjaman/{id}', [KpinjamanController::class, 'pa'])->name('pa.index');

        Route::post('/data-pinjaman', [KpinjamanController::class, 'pinjam'])->name('pa.store');
        Route::post('/data-pinjaman/edit', [KpinjamanController::class, 'editpinjam'])->name('pa.update');
        Route::delete('/data-pinjaman/{id}', [KpinjamanController::class, 'deletepinjam']);
        Route::get('/data-pinjaman/cetak/{id}', [KpinjamanController::class, 'cetak']);

        Route::post('/pinjaman', [KpinjamanController::class, 'store'])->name('pinjaman.store');
        Route::delete('/pinjaman/{id}', [KpinjamanController::class, 'destroy'])->name('pinjaman.destroy');
        Route::post('/pinjaman/edit', [KpinjamanController::class, 'update'])->name('pinjaman.update');
        //Angsuran
        Route::get('/data-pinjaman/{id}/angsuran/{d}', [KtAngsuranController::class, 'angsur'])->name('pa.angsur');
        Route::post('/angsuran/pinjaman', [KtAngsuranController::class, 'store'])->name('angsuran.simpan');

        //pengajuan-pinjam
        Route::get('/data-pengajuan/pinjaman', [kPengajuan::class, 'pinjam'])->name('pengajuan.pinjam');
        Route::post('/data-pengajuan/terima/{id}', [kPengajuan::class, 'terima']);
        //pengajuan-simpan
        Route::get('/data-pengajuan/simpanan', [kPengajuan::class, 'simpan'])->name('pengajuan.simpan');
        Route::post('/data-pengajuan/s/terima/{id}', [kPengajuan::class, 'terimas']);
        //pengajuan-penarikan
        Route::get('/data-pengajuan/penarikan', [kPengajuan::class, 'tarik'])->name('pengajuan.tarik');
        Route::post('/data-pengajuan/t/terima/{id}', [kPengajuan::class, 'terimat']);
        //Admin
        Route::get('user/admin', [adminController::class, 'index'])->name('dataadmin.index');
        Route::post('user/admin', [adminController::class, 'store'])->name('dataadmin.store');
        Route::delete('user/admin/{id}', [adminController::class, 'destroy'])->name('dataadmin.destroy');
        Route::post('user/admin/edit', [adminController::class, 'update'])->name('dataadmin.update');
    });


    //profile
    Route::get('profil', [Controller::class, 'profile'])->name('profil');
    Route::post('profil', [Controller::class, 'profilstore'])->name('profil.store');
});


require __DIR__ . '/auth.php';
