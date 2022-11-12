<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DashboardAdminController;
// use App\Http\Controllers\Admin\DataMasterController;
// use App\Http\Controllers\Admin\BarangKeluarController;
// use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\Admin\DataBarangController;
use App\Http\Controllers\Admin\DataSatuanController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\PembelianController;
// use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\LaporanController;

use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\Karyawan\DashboardKaryawanController;

use App\Http\Controllers\KirimEmailController;
use App\Http\COntrollers\KepalaToko\DashboardTokoController;
use App\Http\COntrollers\KepalaToko\BarangMasukController;
use App\Http\COntrollers\KepalaToko\BarangKeluarController;
use App\Http\COntrollers\KepalaToko\LaporanBarangController;

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

// Route::group(['middleware => auth:sanctum'], function(){

// });



Route::get('formemail', [KirimEmailController::class, 'index']);
Route::post('kirim', [KirimEmailController::class, 'kirim']);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'users'])->name('login');
Route::get('registrasi', [AuthController::class, 'regist'])->name('regist');
Route::post('daftar',[AuthController::class, 'daftar'])->name('daftar');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'authLogin'], function(){
    Route::get('dashboard', [DashboardUserController::class, 'index']);
    Route::get('dashboard-admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    Route::get('profile', [DashboardAdminController::class, 'profile'])->name('profile');
    Route::get('bottom', [DashboardAdminController::class, 'bottom'])->name('bottom');

    //kasir
    Route::resource('data-barang', DataBarangController::class);
    Route::resource('data-satuan', DataSatuanController::class);
    Route::get('kategoriBarang', [KategoriBarangController::class, 'index'])->name('kategoriBarang');
    Route::resource('data-pembelian', PembelianController::class);
    Route::get('data-pembelian/cetak_struk/{id}', [PembelianController::class, 'cetak'])->name('cetak_struk');
    Route::resource('users', DataUserController::class);
    Route::get('laporan-kasir', [PembelianController::class, 'laporan'])->name('laporan.kasir');
    Route::post('filter-laporan', [PembelianController::class, 'filter'])->name('filter.laporan');
    Route::get('cetak-pdf/{dari}/{sampai}', [PembelianController::class, 'cetakPdf']);
    //user
    // Route::post('tambah-user', [DataUserController::class, 'tambah'])->name('tambah-user');
    // Route::post('ubah-user/{id}', [DataUserController::class, 'ubah'])->name('ubah-user');
    // Route::delete('hapus-user/{id}', [DataUserController::class, 'hapus'])->name('hapus-user');
    //kepala toko
    Route::get('dashboard-kepala-toko', [DashboardTokoController::class, 'index'])->name('dashboard.kepala.toko');
    //branng masuk
    Route::get('barangMasuk', [BarangMasukController::class, 'index'])->name('barangMasuk');
    Route::post('tambahDataMasuk', [BarangMasukController::class, 'save'])->name('tambahBarangMasuk');
    Route::post('ubahDataMasuk/{id}', [BarangMasukController::class, 'ubah'])->name('ubah.barang.keluar');
    Route::delete('hapusDataMasuk/{id}', [BarangMasukController::class, 'hapus'])->name('hapus.barang.masuk');
    //barang keluar
    Route::get('barangKeluar', [BarangKeluarController::class, 'index'])->name('barangKeluar');
    Route::post('tambahDataKeluar', [BarangKeluarController::class, 'save'])->name('tambahBarangKeluar');
    Route::post('ubahDataKeluar/{id}', [BarangKeluarController::class, 'ubah']);
    Route::delete('hapusDataKeluar/{id}', [BarangKeluarController::class, 'hapus'])->name('hapus.barang.keluar');
    //lraporan
    Route::get('laporan', [LaporanBarangController::class, 'index'])->name('laporan');
    Route::get('laporanMasuk', [LaporanBarangController::class, 'barangMasuk'])->name('laporanMasuk');
    Route::get('laporanKeluar', [LaporanBarangController::class, 'barangKeluar'])->name('laporanKeluar');
    Route::post('filterMasuk', [LaporanBarangController::class, 'filterMasuk'])->name('filterMasuk');
    Route::post('filterKeluar', [LaporanBarangController::class, 'filterKeluar'])->name('filterKeluar');
    Route::get('cetak-masuk/{dari}/{sampai}', [LaporanBarangController::class, 'cetakMasuk']);
    Route::get('cetak-keluar/{dari}/{sampai}', [LaporanBarangController::class, 'cetakKeluar']);
    // Route::post('filterLaporan', [LaporanBarangController::class, 'filter'])->name('filter');

    Route::post('ubah-profile', [DataUserController::class, 'ubahProfile'])->name('ubah.profile');
});

Route::get('typhead_autocomplit/action', [PembelianController::class, 'action'])->name('typhead_autocomplit.action');