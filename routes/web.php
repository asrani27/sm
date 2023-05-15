<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TkrkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NikahController;
use App\Http\Controllers\UsahaController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AdminSKController;
use App\Http\Controllers\AdminKrkController;
use App\Http\Controllers\KematianController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\TpermohonanController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\DaftarLayananController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\AdminPermohonanController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('superadmin')) {
            return redirect('superadmin');
        } elseif (Auth::user()->hasRole('pemohon')) {
            return redirect('pemohon');
        }
    }
    return redirect('/login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('daftar', [DaftarController::class, 'index']);
Route::post('daftar', [DaftarController::class, 'daftar']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::get('/logout', [LogoutController::class, 'logout']);


Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('superadmin', [HomeController::class, 'superadmin']);
    Route::get('superadmin/gp', [GantiPasswordController::class, 'index']);
    Route::post('superadmin/gp', [GantiPasswordController::class, 'update']);
    Route::post('superadmin/sk/updatelurah', [HomeController::class, 'updatelurah']);

    Route::get('superadmin/user', [AdminController::class, 'user']);
    Route::get('superadmin/user/create', [AdminController::class, 'user_create']);
    Route::post('superadmin/user/create', [AdminController::class, 'user_store']);
    Route::get('superadmin/user/edit/{id}', [AdminController::class, 'user_edit']);
    Route::post('superadmin/user/edit/{id}', [AdminController::class, 'user_update']);
    Route::get('superadmin/user/delete/{id}', [AdminController::class, 'user_delete']);

    Route::get('superadmin/kategori', [AdminController::class, 'kategori']);
    Route::get('superadmin/kategori/create', [AdminController::class, 'kategori_create']);
    Route::post('superadmin/kategori/create', [AdminController::class, 'kategori_store']);
    Route::get('superadmin/kategori/edit/{id}', [AdminController::class, 'kategori_edit']);
    Route::post('superadmin/kategori/edit/{id}', [AdminController::class, 'kategori_update']);
    Route::get('superadmin/kategori/delete/{id}', [AdminController::class, 'kategori_delete']);

    Route::get('superadmin/surat', [AdminController::class, 'surat']);
    Route::get('superadmin/surat/create', [AdminController::class, 'surat_create']);
    Route::post('superadmin/surat/create', [AdminController::class, 'surat_store']);
    Route::get('superadmin/surat/edit/{id}', [AdminController::class, 'surat_edit']);
    Route::post('superadmin/surat/edit/{id}', [AdminController::class, 'surat_update']);
    Route::get('superadmin/surat/delete/{id}', [AdminController::class, 'surat_delete']);

    Route::get('superadmin/petugas', [AdminController::class, 'petugas']);
    Route::get('superadmin/petugas/create', [AdminController::class, 'petugas_create']);
    Route::post('superadmin/petugas/create', [AdminController::class, 'petugas_store']);
    Route::get('superadmin/petugas/edit/{id}', [AdminController::class, 'petugas_edit']);
    Route::post('superadmin/petugas/edit/{id}', [AdminController::class, 'petugas_update']);
    Route::get('superadmin/petugas/delete/{id}', [AdminController::class, 'petugas_delete']);

    Route::get('superadmin/pemeriksaan', [AdminController::class, 'pemeriksaan']);
    Route::get('superadmin/pemeriksaan/create', [AdminController::class, 'pemeriksaan_create']);
    Route::get('superadmin/pemeriksaan/periksa/{id}', [AdminController::class, 'pemeriksaan_create2']);
    Route::post('superadmin/pemeriksaan/create2', [AdminController::class, 'pemeriksaan_store']);
    Route::get('superadmin/pemeriksaan/edit/{id}', [AdminController::class, 'pemeriksaan_edit']);
    Route::post('superadmin/pemeriksaan/edit/{id}', [AdminController::class, 'pemeriksaan_update']);
    Route::get('superadmin/pemeriksaan/delete/{id}', [AdminController::class, 'pemeriksaan_delete']);
    Route::get('superadmin/pemeriksaan/cetak/{id}', [AdminController::class, 'pemeriksaan_cetak']);

    Route::get('superadmin/registrasi', [AdminController::class, 'registrasi']);
    Route::get('superadmin/registrasi/create', [AdminController::class, 'registrasi_create']);
    Route::post('superadmin/registrasi/create', [AdminController::class, 'registrasi_store']);
    Route::get('superadmin/registrasi/edit/{id}', [AdminController::class, 'registrasi_edit']);
    Route::post('superadmin/registrasi/edit/{id}', [AdminController::class, 'registrasi_update']);
    Route::get('superadmin/registrasi/delete/{id}', [AdminController::class, 'registrasi_delete']);

    Route::get('superadmin/laporan', [AdminController::class, 'laporan']);
    Route::get('laporan/petugas', [AdminController::class, 'lap_petugas']);
    Route::get('laporan/registrasi', [AdminController::class, 'lap_registrasi']);
    Route::get('laporan/pemeriksaan', [AdminController::class, 'lap_pemeriksaan']);
    Route::get('laporan/rekapitulasi', [AdminController::class, 'lap_rekapitulasi']);
});
