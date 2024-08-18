<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiPermintaanController;
use App\Http\Controllers\TransaksiPengadaanController;

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


Auth::routes([
    'register' => true,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// //hanya untuk role admin
// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']],
//     function() {
//         Route::get('/', function() {
//             return view('admin.index');
//         });

//         Route::get('/cetak-laporan', function() {
//             return view('admin.cetak-laporan.index');
//         });

//         Route::get('profile', function() {
//             return 'halaman profile admin';
//         });

// });

// //hanya untuk petugas
// Route::group(['prefix' => 'petugas', 'middleware' => ['auth', 'role:petugas|admin']],
//     function() {
//         Route::get('/', function() {
//             return 'halaman petugas';
//         });

//         Route::get('profile', function() {
//             return 'halaman profile petugas';
//         });

// });

// Route::get('/cetak-laporan', function() {
//     return view('admin.cetak-laporan.index');
// });

// Route::get('user-management', [App\Http\Controllers\UserController::class, 'users']);

// Route::get('cetak-barang-masuk', [App\Http\Controllers\BarangMasukController::class, 'cetakBm']);

// Route::get('cetak-barang-keluar', [App\Http\Controllers\BarangKeluarController::class, 'cetakBk']);


// //tes-fitur

// Route::resource('supplier', SupplierController::class);

// Route::resource('satuan', SatuanController::class);

// Route::resource('jenis', JenisController::class);

// Route::resource('barang', BarangController::class);

// Route::resource('barang-masuk', BarangMasukController::class);

// Route::resource('barang-keluar', BarangKeluarController::class);

Route::group(['prefix' => 'pengadaanbarang', 'middleware' => ['auth']], function(){
    Route::resource('supplier', SupplierController::class)
    ->middleware(['role:petugas|admin']);

    Route::resource('satuan', SatuanController::class)
    ->middleware(['role:admin|petugas']);

    Route::resource('jenis', JenisController::class)
    ->middleware(['role:admin|petugas']);

    Route::resource('barang', BarangController::class)
    ->middleware(['role:admin|petugas']);

    Route::resource('barang-masuk', BarangMasukController::class)
    ->middleware(['role:admin|petugas']);

    Route::resource('barang-keluar', BarangKeluarController::class)
    ->middleware(['role:admin|petugas']);

    Route::resource('transaksi', TransaksiController::class)
    ->middleware(['role:admin|petugas']);

    Route::resource('user-management', UserController::class)
    ->middleware(['role:admin']);

    Route::get('cetak-laporan', [App\Http\Controllers\ReportController::class, 'index'])
    ->middleware(['role:admin|petugas']);

    Route::post('cetak-laporan', [App\Http\Controllers\ReportController::class, 'laporan'])
    ->middleware(['role:admin|petugas']);

    Route::resource('transaksi-permintaan', TransaksiPermintaanController::class)
    ->middleware(['role:admin|petugas']);

    Route::resource('transaksi-pengadaan', TransaksiPengadaanController::class)
    ->middleware(['role:admin']);
});

Route::post('/transaksi-pengadaan', [TransaksiPengadaanController::class, 'store'])->name('transaksi.store');