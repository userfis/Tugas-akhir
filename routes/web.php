<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Datacontroller;
use App\Http\Controllers\DataInformasicontroller;
use App\Http\Controllers\DatakeluarController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeknisController;
use App\Http\Controllers\HukumController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);

Route::get('/home',[Datacontroller::class, 'dashboard'])->middleware('auth')->name('home');
Route::get('/master-data',[DataInformasicontroller::class, 'keluar'])->middleware('auth')->name('surat-keluar');

Route::get('/decrypt-file/{data:id}',[DataInformasicontroller::class, 'show'])->middleware('auth');
Route::get('/data-masuk',[DataInformasicontroller::class, 'masuk'])->middleware('auth')->name('masuk');
Route::get('/data-keluar',[DatakeluarController::class, 'dataKeluar'])->middleware('auth')->name('keluar');
Route::get('/tambah/surat-keluar',[DataInformasiController::class, 'viewTambahSK'])->middleware('auth')->name('tambah-SK');
Route::post('/create-sk',[DataInformasicontroller::class, 'createSK'])->middleware('auth')->name('create-SK');
// Route::get('/kirim-email',[DataInformasiController::class, 'email'])->middleware('auth');
Route::get('/tambah-data',[DataInformasicontroller::class, 'viewTambah'])->middleware('auth')->name('tambah');
Route::post('/create-data',[DataInformasicontroller::class, 'createDataInformasi'])->middleware('auth')->name('tambah_data');
Route::post('/{data:id}/hapus',[DataInformasicontroller::class,'hapusDatainformasi'])->middleware('auth');
Route::get('/{data:id}/detail-surat',[DataInformasicontroller::class, 'viewDetail'])->middleware('auth');
Route::get('/{data:id}/edit-data',[DataInformasicontroller::class, 'viewEdit'])->middleware('auth');
// Route::post('/{data:id}/kirim-email',[DataInformasiController::class, 'email'])->middleware('auth');
Route::post('/{data:id}/update-data',[DataInformasicontroller::class, 'editDataInformasi'])->middleware('auth');
Route::post('/{data:id}/admin/update-data',[DataInformasicontroller::class, 'adminEditDataInformasi'])->middleware('auth');
//Route::get('/download/{data}',[DataInformasicontroller::class,'download'])->middleware('auth')->name('download');

Route::get('/keuangan/master-data',[KeuanganController::class, 'keluar'])->middleware('auth')->name('keluar-keuangan');
Route::get('/keuangan/data-masuk',[KeuanganController::class, 'masuk'])->middleware('auth')->name('masuk-keuangan');
Route::get('/keuangan/tambah-data',[KeuanganController::class, 'viewTambah'])->middleware('auth')->name('tambah-keluar-staff');
Route::post('/keuangan/create-data',[KeuanganController::class, 'createKeluar'])->middleware('auth')->name('create-keluar-staff');
Route::post('/{data:id}/keuangan/hapus',[KeuanganController::class, 'hapusKeuangan'])->middleware('auth');
Route::get('/{data:id}/keuangan/edit-data',[KeuanganController::class, 'viewEdit'])->middleware('auth');
Route::post('/{data:id}/keuangan/update-data',[KeuanganController::class, 'editKeuangan'])->middleware('auth');
Route::post('/{data:id}/keuangan/admin/update-data',[KeuanganController::class, 'adminEditKeuangan'])->middleware('auth');

// Route::get('/teknis/master-data',[TeknisController::class, 'master'])->middleware('auth')->name('master-teknis');
// Route::get('/teknis/data-masuk',[TeknisController::class, 'masuk'])->middleware('auth')->name('masuk-teknis');
// Route::get('/teknis/tambah-data',[TeknisController::class, 'viewTambah'])->middleware('auth')->name('tambah-teknis');
// Route::post('/teknis/create-data',[TeknisController::class, 'createTeknis'])->middleware('auth')->name('create-teknis');
// Route::get('/{data:id}/teknis/edit-data',[TeknisController::class, 'viewEdit'])->middleware('auth');
// Route::post('/{data:id}/teknis/update-data',[TeknisController::class, 'editTeknis'])->middleware('auth');
// Route::post('/{data:id}/teknis/admin/update-data',[TeknisController::class, 'adminEditteknis'])->middleware('auth');
// Route::post('/{data:id}/teknis/hapus',[TeknisController::class, 'hapusDatateknis'])->middleware('auth');

Route::get('/hukum/master-data',[HukumController::class, 'keluar'])->middleware('auth')->name('keluar-hukum');
Route::get('/hukum/data-masuk',[HukumController::class, 'masuk'])->middleware('auth')->name('masuk-hukum');
Route::get('/hukum/tambah-data',[HukumController::class, 'viewTambah'])->middleware('auth')->name('tambah-keluar');
Route::post('/hukum/create-data',[HukumController::class, 'createKeluar'])->middleware('auth')->name('create-keluar');
Route::get('/{data:id}/hukum/edit-data',[HukumController::class, 'viewEdit'])->middleware('auth');
Route::post('/{data:id}/hukum/update-data',[HukumController::class, 'editHukum'])->middleware('auth');
Route::post('/{data:id}/hukum/admin/update-data',[HukumController::class, 'adminEdithukum'])->middleware('auth');
Route::post('/{data:id}/hukum/hapus',[HukumController::class, 'hapusDatahukum'])->middleware('auth');

Route::get('/{data:id}/kirim-data',[DatakeluarController::class, 'kirimData'])->middleware('auth');
Route::post('/{data:id}/kirim-email',[DatakeluarController::class, 'email'])->middleware('auth');



