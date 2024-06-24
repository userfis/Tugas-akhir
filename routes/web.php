<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Datacontroller;
use App\Http\Controllers\DataInformasicontroller;
use App\Http\Controllers\DatakeluarController;
use App\Http\Controllers\ForgotPasswordController;
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
Route::post('/reset-password/{id}', [ForgotPasswordController::class, 'sendResetLink'])->name('reset-password.send');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('reset-password.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password.update');

Route::get('/',[LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);

Route::get('/home',[Datacontroller::class, 'dashboard'])->middleware('auth')->name('home');
Route::get('/arsip/export-excel-sm',[DataInformasicontroller::class, 'exportExcelSM'])->name('exportExcel-sm');
Route::get('/arsip/export-excel-sk',[DataInformasicontroller::class, 'exportExcelSK'])->name('exportExcel-sk');
// Route::get('/{data:id}/kirim-email',[DatakeluarController::class, 'kirimData'])->middleware('auth');
Route::get('/surat-masuk/search', [DataInformasicontroller::class, 'search'])->middleware('auth','multiple.roles:0')->name('data-search');
Route::get('/surat-keluar',[DataInformasicontroller::class, 'keluar'])->middleware('auth','multiple.roles:0')->name('surat-keluar');
Route::get('/surat-keluar/search', [DataInformasicontroller::class, 'searchSK'])->middleware('auth','multiple.roles:0')->name('keluar-search');
Route::get('/data-user',[DataInformasicontroller::class, 'user'])->middleware('auth','multiple.roles:0')->name('data-user');
Route::get('/tambah/data-user',[DataInformasicontroller::class, 'tambahUser'])->middleware('auth','multiple.roles:0')->name('tambah-user');
Route::post('/{user:id}/hapus-user',[DataInformasicontroller::class, 'deleteUser'])->middleware('auth','multiple.roles:0');
Route::get('/{user:id}/edit-user',[DataInformasicontroller::class, 'editUser'])->middleware('auth','multiple.roles:0');
Route::post('/{user:id}/update-user',[DataInformasicontroller::class, 'updateUser'])->middleware('auth','multiple.roles:0');
Route::post('/create/data-user', [DataInformasicontroller::class, 'createUser'])->middleware('auth','multiple.roles:0')->name('create-user');
// Route::get('/decrypt-file/{data:id}',[DataInformasicontroller::class, 'show'])->middleware('auth');
Route::get('/data-masuk',[DataInformasicontroller::class, 'masuk'])->middleware('auth','multiple.roles:0')->name('masuk');
Route::get('/master/arsip-sm',[DataInformasicontroller::class, 'arsip'])->middleware('auth','multiple.roles:0')->name('arsip');
Route::get('/search/master/arsip-sm',[DataInformasicontroller::class, 'searchArsip'])->middleware('auth','multiple.roles:0')->name('search-arsip');
Route::get('/master/arsip-sk',[DataInformasicontroller::class, 'arsipKeluar'])->middleware('auth','multiple.roles:0')->name('surat-keluar-arsip');
Route::get('/search/master/arsip-sk',[DataInformasicontroller::class, 'searchArsipSK'])->middleware('auth','multiple.roles:0')->name('search-surat-keluar-arsip');
Route::get('/master/kategori',[DataInformasicontroller::class, 'kategori'])->middleware('auth','multiple.roles:0')->name('kategori');
Route::get('/master/disposisi/search',[DataInformasicontroller::class, 'searchDisposisi'])->middleware('auth','multiple.roles:0')->name('search-disposisi');
Route::get('/master/disposisi',[DataInformasicontroller::class, 'disposisi'])->middleware('auth','multiple.roles:0')->name('disposisi');
Route::get('/master/daftar-rak',[DataInformasicontroller::class, 'rak'])->middleware('auth','multiple.roles:0')->name('rak');
Route::get('/master/daftar-pass',[DataInformasicontroller::class, 'enkripPass'])->middleware('auth','multiple.roles:0')->name('pass');
Route::post('/pass/update/{id}', [DataInformasicontroller::class, 'editPassDekripsi'])->middleware('auth','multiple.roles:0')->name('pass.update');
Route::post('/create/rak',[DataInformasicontroller::class, 'createRak'])->middleware('auth','multiple.roles:0')->name('tambah-rak');
Route::post('/rak/update/{id}', [DataInformasicontroller::class, 'updateRak'])->middleware('auth','multiple.roles:0')->name('rak.update');
Route::post('/{rak:id}/hapus/rak',[DataInformasicontroller::class, 'hapusRak'])->middleware('auth','multiple.roles:0');
Route::get('/rak/{id}',[DataInformasicontroller::class, 'show'])->middleware('auth','multiple.roles:0');
Route::post('/create/kategori',[DataInformasicontroller::class, 'createKategori'])->middleware('auth','multiple.roles:0')->name('tambah-kategori');
Route::post('/{kategori:id}/hapus/kategori',[DataInformasicontroller::class, 'hapusKategori'])->middleware('auth','multiple.roles:0');
Route::post('/update/kategori/{kategori:id}',[DataInformasicontroller::class, 'updateKategori'])->middleware('auth','multiple.roles:0');
Route::get('/data-keluar',[DatakeluarController::class, 'dataKeluar'])->middleware('auth','multiple.roles:0')->name('keluar');
Route::get('/{data:id}/edit-data-sk',[DataInformasicontroller::class, 'viewEditSK'])->middleware('auth','multiple.roles:0');
Route::post('/{data:id}/update-data-sk',[DataInformasicontroller::class, 'editSKAdmin'])->middleware('auth','multiple.roles:0');
Route::get('/tambah/surat-keluar',[DataInformasiController::class, 'viewTambahSK'])->middleware('auth','multiple.roles:0')->name('tambah-SK');
Route::post('/create-sk',[DataInformasicontroller::class, 'createSK'])->middleware('auth','multiple.roles:0')->name('create-SK');
// Route::get('/kirim-email',[DataInformasiController::class, 'email'])->middleware('auth','multiple.roles:0');
Route::get('/tambah-data',[DataInformasicontroller::class, 'viewTambah'])->middleware('auth','multiple.roles:0')->name('tambah');
Route::post('/create-data',[DataInformasicontroller::class, 'createDataInformasi'])->middleware('auth','multiple.roles:0')->name('tambah_data');
Route::post('/{data:id}/hapus',[DataInformasicontroller::class,'hapusDatainformasi'])->middleware('auth','multiple.roles:0,1,2,3,4,5,6');
Route::get('/{data:id}/detail-surat',[DataInformasicontroller::class, 'viewDetail'])->middleware('auth','multiple.roles:0');
Route::get('/{data:id}/detail-surat-keluar',[DataInformasicontroller::class, 'viewDetailSK'])->middleware('auth','multiple.roles:0');
Route::get('/{data:id}/edit-data',[DataInformasicontroller::class, 'viewEdit'])->middleware('auth','multiple.roles:0');
// Route::post('/{data:id}/kirim-email',[DataInformasiController::class, 'email'])->middleware('auth','multiple.roles:0');
Route::post('/{data:id}/update-data',[DataInformasicontroller::class, 'editDataInformasi'])->middleware('auth','multiple.roles:0');
Route::post('/{data:id}/admin/update-data',[DataInformasicontroller::class, 'adminEditDataInformasi'])->middleware('auth','multiple.roles:0');
//Route::get('/download/{data}',[DataInformasicontroller::class,'download'])->middleware('auth')->name('download');

Route::get('/staff/surat-keluar',[KeuanganController::class, 'keluar'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('staff-sk');
Route::get('/staff/surat-keluar/search', [KeuanganController::class, 'searchSKStaff'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('keluar-search-staff');
Route::get('/staff/surat-masuk',[KeuanganController::class, 'masuk'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('staff-sm');
Route::get('/staff/surat-masuk/search', [KeuanganController::class, 'searchSMStaff'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('masuk-search-staff');
Route::get('/keuangan/tambah-data',[KeuanganController::class, 'viewTambah'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('tambah-keluar-staff');
Route::post('/keuangan/create-data',[KeuanganController::class, 'createKeluar'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('create-keluar-staff');
Route::post('/{data:id}/keuangan/hapus',[KeuanganController::class, 'hapusKeuangan'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::get('/{data:id}/staff/konfirm-sm',[KeuanganController::class, 'viewEdit'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::post('/{data:id}/staff/update-sm',[KeuanganController::class, 'konfirmSM'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::get('/{data:id}/staff/konfirm-sk',[KeuanganController::class, 'viewkonfirmSk'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::post('/{data:id}/staff/update-konfirm-sk',[KeuanganController::class, 'konfirmSK'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::get('/{data:id}/staff/edit-sk',[KeuanganController::class, 'editSK'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::post('/{data:id}/update/edit-sk',[KeuanganController::class, 'updateSk'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::post('/{data:id}/terima-sm',[KeuanganController::class, 'terimaSM'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::post('/{data:id}/keuangan/admin/update-data',[KeuanganController::class, 'adminEditKeuangan'])->middleware(['auth','multiple.roles:3,4,5,6']);
Route::get('/staff/arsip-sm',[KeuanganController::class, 'arsipSM'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('arsip-staff-sm');
Route::get('/staff/arsip-sk',[KeuanganController::class, 'arsipSK'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('arsip-staff-sk');
Route::get('/search/arsip-sm',[KeuanganController::class, 'searchSM'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('search-sm');
Route::get('/search/arsip-sk',[KeuanganController::class, 'searchSK'])->middleware(['auth','multiple.roles:3,4,5,6'])->name('search-sk');
Route::post('/dekripsi/{data:id}',[KeuanganController::class, 'dekripsi'])->middleware('auth');

// Route::get('/teknis/master-data',[TeknisController::class, 'master'])->middleware('auth')->name('master-teknis');
// Route::get('/teknis/data-masuk',[TeknisController::class, 'masuk'])->middleware('auth')->name('masuk-teknis');
// Route::get('/teknis/tambah-data',[TeknisController::class, 'viewTambah'])->middleware('auth')->name('tambah-teknis');
// Route::post('/teknis/create-data',[TeknisController::class, 'createTeknis'])->middleware('auth')->name('create-teknis');
// Route::get('/{data:id}/teknis/edit-data',[TeknisController::class, 'viewEdit'])->middleware('auth');
// Route::post('/{data:id}/teknis/update-data',[TeknisController::class, 'editTeknis'])->middleware('auth');
// Route::post('/{data:id}/teknis/admin/update-data',[TeknisController::class, 'adminEditteknis'])->middleware('auth');
// Route::post('/{data:id}/teknis/hapus',[TeknisController::class, 'hapusDatateknis'])->middleware('auth');

Route::get('/pimpinan/surat-keluar',[HukumController::class, 'keluar'])->middleware(['auth','multiple.roles:1,2'])->name('pimpinan-sk');
Route::get('/pimpinan/surat-keluar/search',[HukumController::class, 'searchSKPim'])->middleware('auth','multiple.roles:1,2')->name('keluar-pim-search');
Route::get('/cek-surat-masuk',[HukumController::class, 'cekSM'])->middleware('auth','multiple.roles:1,2')->name('cek-sm');
Route::get('/cek-surat-keluar',[HukumController::class, 'cekSK'])->middleware('auth','multiple.roles:1,2')->name('cek-sk');
Route::get('/pimpinan/surat-masuk/search',[HukumController::class, 'searchSMPim'])->middleware('auth','multiple.roles:1,2')->name('masuk-pim-search');
Route::get('/pimpinan/surat-masuk',[HukumController::class, 'masuk'])->middleware('auth','multiple.roles:1,2')->name('masuk-hukum');
Route::post('/{data:id}/terima-smp',[HukumController::class, 'terimaSMP'])->middleware('auth','multiple.roles:1,2');
Route::get('/pimpinan/tambah-data',[HukumController::class, 'viewTambah'])->middleware('auth','multiple.roles:1,2')->name('tambah-keluar');
Route::post('/hukum/create-data',[HukumController::class, 'createKeluar'])->middleware('auth','multiple.roles:1,2')->name('create-keluar');
Route::get('/{data:id}/confirm-sm',[HukumController::class, 'viewKonfirm'])->middleware('auth','multiple.roles:1,2');
Route::get('/{data:id}/confirm-sk',[HukumController::class, 'viewKonfirmSK'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/update-sm',[HukumController::class, 'konfirmSM'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/update-sk',[HukumController::class, 'konfirmSK'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/update/sk',[HukumController::class, 'editKeluar'])->middleware('auth','multiple.roles:1,2');
Route::get('/{data:id}/edit-sk-pimpinan',[HukumController::class, 'editSK'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/update-skp',[HukumController::class, 'konfirmSKP'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/update-smp',[HukumController::class, 'konfirmSMP'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/hukum/admin/update-data',[HukumController::class, 'adminEdithukum'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/hukum/hapus',[HukumController::class, 'hapusDatahukum'])->middleware('auth','multiple.roles:1,2');
Route::get('/{data:id}/pimpinan/konfirm-smp',[HukumController::class, 'viewEdit'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/pimpinan/update-smp',[HukumController::class, 'arsipSM'])->middleware('auth','multiple.roles:1,2');
Route::get('/{data:id}/pimpinan/konfirm-skp',[HukumController::class, 'viewarsipkanSKP'])->middleware('auth','multiple.roles:1,2');
Route::post('/{data:id}/pimpinan/update-skp',[HukumController::class, 'arsipkanSKP'])->middleware('auth','multiple.roles:1,2');
Route::get('/pimpinan/arsip-sm',[HukumController::class, 'arsipSMP'])->middleware('auth','multiple.roles:1,2')->name('arsip-sm-pim');
Route::get('/pimpinan/arsip-sk',[HukumController::class, 'arsipSKP'])->middleware('auth','multiple.roles:1,2')->name('arsip-sk-pim');
Route::get('search/pimpinan/arsip-sm',[HukumController::class, 'arsipSMP'])->middleware('auth','multiple.roles:1,2')->name('search-arsip-sm-pim');
Route::get('search/pimpinan/arsip-sk',[HukumController::class, 'searchSK'])->middleware('auth','multiple.roles:1,2')->name('search-arsip-sk-pim');




Route::get('/{data:id}/kirim-email',[DatakeluarController::class, 'kirimData'])->middleware('auth');
Route::post('/{data:id}/send-kirim-email',[DatakeluarController::class, 'email'])->middleware('auth');



