<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSalamanController;
use App\Http\Controllers\DatapinjamanController;
use App\Http\Controllers\DepartemenControlller;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::get('/',function(){
    //return "hay";
    return view('pinjamsarpras.landingpage');

})->name('landingpage');

Route::get('/formpinjamkendaraan', [DatapinjamanController::class, 'formpinjamkendaraan'])->name('formpinjamkendaraan');
Route::post('/storepinjamkendaraan', [DatapinjamanController::class, 'storepinjamkendaraan'])->name('storepinjamkendaraan');
Route::get('/formpinjamruangan', [DatapinjamanController::class, 'formpinjamruangan'])->name('formpinjamruangan');
Route::post('/storepinjamruangan', [DatapinjamanController::class, 'storepinjamruangan'])->name('storepinjamruangan');

/*cek kode booking*/
Route::get('/cekkodebooking', [DatapinjamanController::class, 'cekkodebooking'])->name('cekkodebooking');
Route::post('/showhistori', [DatapinjamanController::class, 'showhistori'])->name('showhistori');
Route::post('/tampilkankodebooking', [DatapinjamanController::class, 'tampilkankodebooking'])->name('tampilkankodebooking');

/*login SALAMAN*/
Route::middleware(['guest:salaman'])->group(function(){
    Route::post('/prosesloginsalaman',[AuthController::class,'prosesloginsalaman'])->name('prosesloginsalaman');
    Route::get('/loginsalaman',function(){
        //return "woy";
        return view('auth.loginsalaman');
    })->name('loginsalaman');

});

Route::middleware(['auth:salaman', 'checkrole'])->group(function(){
    /*proses logout space*/
    Route::get('/proseslogoutsalaman', [AuthController::class, 'proseslogoutsalaman'])->name('proseslogoutsalaman');
    Route::get('/panelsalaman/dashboardsalaman', [DashboardController::class, 'dashboardsalaman'])->name('dashboardsalaman');

    /*DATA KENDARAAN*/
    Route::get('/kendaraandata',[KendaraanController::class,'kendaraandata'])->name('kendaraandata')->middleware('admin');
    Route::post('/kendaraan/store',[KendaraanController::class,'kendaraanstore'])->name('kendaraanstore');
});

Route::get('/presensi/buatizin',[PresensiController::class,'buatizin'])->name('buatizin');

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});





Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
    Route::get('/presensi/create',[PresensiController::class,'create'])->name('presensi.create');
    Route::post('/presensi/store',[PresensiController::class,'store']);
    Route::get('/editprofile',[PresensiController::class,'editprofile'])->name('editprofile');
    Route::post('/presensi/{nik}/updateprofile',[PresensiController::class,'updateprofile']);
    Route::get('/presensi/histori',[PresensiController::class,'histori'])->name('presensi.histori');
    Route::post('/gethistori',[PresensiController::class,'gethistori']);

    Route::get('/presensi/izin',[PresensiController::class,'izin'])->name('presensi.izin');
//    Route::get('/presensi/buatizin',[PresensiController::class,'buatizin'])->name('buatizin');
    Route::post('/presensi/storeizin',[PresensiController::class,'storeizin']);

    Route::post('/presensi/cekpengajuanizin',[PresensiController::class,'cekpengajuanizin']);


});

/*panel SALAMAN*/
Route::middleware(['auth:usersalaman'])->group(function(){
    Route::get('panelsalaman/dashboardusersalaman',[DashboardSalamanController::class,'dashboardusersalaman'])->name('dashboardusersalaman');
});

Route::middleware(['auth:user'])->group(function(){
    Route::get('/proseslogoutadmin',[AuthController::class,'proseslogoutadmin']);
    Route::get('panel/dashboardadmin',[DashboardController::class,'dashboardadmin']);

    //Karyawan
    Route::get('/karyawan',[KaryawanController::class,'index']);
    Route::post('/karyawan/store',[KaryawanController::class,'store']);
    Route::post('/karyawan/edit',[KaryawanController::class,'edit']);
    Route::post('/karyawan/{nik}/update',[KaryawanController::class,'update']);
    Route::post('/karyawan/{nik}/delete',[KaryawanController::class,'delete']);

    //Departemen
    Route::get('/departemen',[DepartemenControlller::class,'index']);
    Route::post('/departemen/store',[DepartemenControlller::class,'store']);
    Route::post('/departemen/edit',[DepartemenControlller::class,'edit']);
    Route::post('/departemen/{kode_dept}/update',[DepartemenControlller::class,'update']);
    Route::post('/departemen/{kode_dept}/delete',[DepartemenControlller::class,'delete']);

    //Presensi
    Route::get('/presensi/monitoring',[PresensiController::class,'monitoring']);
    Route::post('/getpresensi',[PresensiController::class,'getpresensi'])->name('getpresensi');
    Route::post('/tampilkanpeta',[PresensiController::class,'tampilkanpeta']);
    Route::get('/presensi/laporan',[PresensiController::class,'laporan']);
    Route::post('/presensi/cetaklaporan',[PresensiController::class,'cetaklaporan']);
    Route::get('/presensi/rekap',[PresensiController::class,'rekap']);
    Route::post('/presensi/cetakrekap',[PresensiController::class,'cetakrekap']);
    Route::get('/presensi/izinsakit',[PresensiController::class,'izinsakit']);
    Route::post('/presensi/approveizinsakit',[PresensiController::class,'approveizinsakit']);
    Route::get('/presensi/{id}/batalkanizinsakit',[PresensiController::class,'batalkanizinsakit']);

    //Cabang
    Route::get('/cabang',[CabangController::class,'index']);
    Route::post('/cabang/store',[CabangController::class,'store']);
    Route::post('/cabang/edit',[CabangController::class,'edit']);
    Route::post('/cabang/update',[CabangController::class,'update']);
    Route::post('/cabang/{kode_cabang}/delete',[CabangController::class,'delete']);

    //Konfigurasi
    Route::get('/konfigurasi/lokasikantor',[KonfigurasiController::class,'lokasikantor']);
    Route::post('/konfigurasi/updatelokasikantor',[KonfigurasiController::class,'updatelokasikantor']);
    Route::get('/konfigurasi/jamkerja',[KonfigurasiController::class,'jamkerja'])->name('konfigurasi.jamkerja');
    Route::post('/konfigurasi/storejamkerja',[KonfigurasiController::class,'storejamkerja']);
    Route::post('/konfigurasi/editjamkerja',[KonfigurasiController::class,'editjamkerja']);
    Route::post('/konfigurasi/updatejamkerja',[KonfigurasiController::class,'updatejamkerja']);
    Route::post('/konfigurasi/jamkerja/{kode_jam_kerja}/delete',[KonfigurasiController::class,'deletejamkerja']);
    Route::get('/konfigurasi/{nik}/setjamkerja',[KonfigurasiController::class,'setjamkerja']);
    Route::post('/konfigurasi/storesetjamkerja',[KonfigurasiController::class,'storesetjamkerja']);
    Route::post('/konfigurasi/updatesetjamkerja',[KonfigurasiController::class,'updatesetjamkerja']);
    //Route::post('/konfigurasi/{kode_jam_kerja}/delete',[KonfigurasiController::class,'updatesetjamkerja']);


});

