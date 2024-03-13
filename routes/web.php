<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Datacontroller;
use App\Http\Controllers\DataInformasicontroller;
use App\Http\Controllers\DatakeluarController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LoginController;

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
Route::get('/master-data',[DataInformasicontroller::class, 'master'])->middleware('auth')->name('master');
Route::get('/data-masuk',[DataInformasicontroller::class, 'masuk'])->middleware('auth')->name('masuk');
Route::get('/data-keluar',[DatakeluarController::class, 'dataKeluar'])->middleware('auth')->name('keluar');
Route::get('/tambah-data',[DataInformasicontroller::class, 'viewTambah'])->middleware('auth')->name('tambah');
Route::post('/create-data',[DataInformasicontroller::class, 'createDataInformasi'])->middleware('auth')->name('tambah_data');
Route::post('/{data:id}/hapus',[DataInformasicontroller::class,'hapusDatainformasi'])->middleware('auth');
Route::get('/{data:id}/edit-data',[DataInformasicontroller::class, 'viewEdit'])->middleware('auth');
Route::post('/{data:id}/update-data',[DataInformasicontroller::class, 'editDataInformasi'])->middleware('auth');

Route::get('/keuangan/master-data',[KeuanganController::class, 'master'])->middleware('auth')->name('master-keuangan');
Route::get('/keuangan/data-masuk',[KeuanganController::class, 'masuk'])->middleware('auth')->name('masuk-keuangan');
Route::get('/keuangan/tambah-data',[KeuanganController::class, 'viewTambah'])->middleware('auth')->name('tambah-keuangan');
Route::post('/keuangan/create-data',[KeuanganController::class, 'createKeuangan'])->middleware('auth')->name('create-keuangan');
Route::post('/{data:id}/keuangan/hapus',[KeuanganController::class, 'hapusKeuangan'])->middleware('auth');
Route::get('/{data:id}/keuangan/edit-data',[KeuanganController::class, 'viewEdit'])->middleware('auth');
Route::post('/{data:id}/keuangan/update-data',[KeuanganController::class, 'editKeuangan'])->middleware('auth');




