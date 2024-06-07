<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Data;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Email;
use App\Models\Divisi;
use App\Mail\Kirimemail;
use App\Models\Ketegori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DataInformasicontroller extends Controller
{

    public function createUser(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'is_admin' => 'required',

        ],[
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);
        Alert::success('Success Title', 'Tambah User Berhasil !');
        return redirect('/data-user');
    }

    public function tambahUser(){
        return view('dataInformasi.tambahUser', [

            'Halaman' => 'Daftar Data User',
            'data' => User::all()
        ]); 
    }

    public function editUser(User $user){
        return view('dataInformasi.editUser', [

            'Halaman' => 'Daftar Data User',
            'user' => $user
        ]); 
    }


    public function updateUser(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email',
            'username' => 'required|string|max:255',
            'is_admin' => 'required',
            'current_password' => 'required_with:password|string',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'current_password.required_with' => 'Kolom password lama harus diisi jika ingin mengubah password.',
            'password.min' => 'Password baru harus terdiri dari minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);
    
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }
    
        $user->update($validatedData);
    
        Alert::success('Success Title', 'Update User Berhasil !');
        return redirect('/data-user');
    }
    


    public function user(){

        return view('dataInformasi.dataUser', [

            'Halaman' => 'Daftar Data User',
            'data' => User::all()
        ]); 
    }
    public function keluar()
    {

        $data = Data::where('data_id', '=', '2')
        ->latest()
        ->get();


        return view('dataInformasi.keluar', [

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function masuk()
    {

       $data = Data::where('data_id', '=', '1')
       ->latest()
       ->get();
        return view('dataInformasi.masuk', [

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function arsip()
    {

        // $arsip = Arsip::where('data_id', '=', '1')->leftJoin('arsips' , 'arsips.surat_id', 'data.id')
        // ->get();
        // $arsip = Arsip::with('data')
        // // ->where('data_id', '=', '1')
        // ->get();

        $arsip = DB::table('data')->where('data_id', '1')
            ->leftJoin('arsips', 'arsips.surat_id', 'data.data_id')
            ->leftJoin('raks', 'raks.id', 'arsips.rak_id')
            ->get();
        // dd($arsip);

        return view('dataInformasi.arsip', [

            'Halaman' => 'Data & Informasi',
            'arsip' => $arsip
        ]);
    }

    public function kategori(){

        return view('dataInformasi.kategori', [
            'kategori' => Ketegori::all(),
            'Halaman' => 'Kategori Surat'
        ]);

    }

    public function updateKategori(Request $request, Ketegori $kategori)
    {
        // dd($request);
        $validatedData = $request->validate([
            'kategori_surat' => 'required|string|max:255',
        ]);

        $kategori->update($validatedData);

        Alert::success('Success Title', 'Update data berhasil!');
        return redirect('/master/kategori');
    }

    public function createKategori(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'kategori_surat' => 'required',
        ]);

        Ketegori::create($validatedData);
        Alert::success('Success Title', 'Tambah data berhasil !');
        return redirect('/master/kategori');
    }

    public function hapusKategori(Ketegori $kategori)
    {
        // dd($request);
        Ketegori::destroy($kategori->id);
        Alert::success('Success', 'data berhasil di hapus !');
        return redirect('/master/kategori');
    }

    public function rak(){

        return view('dataInformasi.rak', [
            'rak' => Rak::all(),
            'halaman' => 'Daftar Rak'
        ]);
    }

    // public function show($id){
    //     $rak = Rak::find($id);
    //     return response()->json($rak);
    // }

    public function createRak(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'pemilik_rak' => 'required',
            'nama_rak' => 'required',
        ]);

        Rak::create($validatedData);
        Alert::success('Success Title', 'Tambah data berhasil !');
        return redirect('/master/daftar-rak');
    }

    public function hapusRak(Rak $rak)
    {
        // dd($request);
        Rak::destroy($rak->id);
        Alert::success('Success', 'Jenis Rak Berhasil di Hapus !');
        return redirect('/master/daftar-rak');
    }

    public function updateRak(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'nama_rak' => 'required|string|max:255',
            'pemilik_rak' => 'required|string|max:255',
        ]);

        // Update data ke database
        $rak = Rak::find($id);
        $rak->nama_rak = $request->input('nama_rak');
        $rak->pemilik_rak = $request->input('pemilik_rak');
        $rak->save();

        Alert::success('Success', 'Data Berhasil di Update !');
        return redirect('/master/daftar-rak');
    }
    


    public function viewTambah()
    {
        $kategori = Ketegori::all();
        $rak = Rak::all();
        return view('dataInformasi.tambahdata', [
            'kategori' => $kategori,
            'rak' => $rak
        ]);
    }

    public function viewTambahSK()
    {
        $kategori = Ketegori::all();
        $rak = Rak::all();
        return view('dataInformasi.createKeluarAdmin', [
            'kategori' => $kategori,
            'rak' => $rak
        ]);
    }

    public function viewDetail(Data $data)
    {
        return view('dataInformasi.detailSurat', [
            'data' => $data,
            // 'divisi' => Divisi::all()
        ]);
    }

    public function viewEdit(Data $data)
    {

        return view('dataInformasi.editData', [
            'data' => $data,
            'kategori' => Ketegori::all()
            // 'divisi' => Divisi::all()
        ]);
    }

    public function createSK(Request $request)
    {
        // dd($request);
        $request->merge(['pass_id' => (string) 2]);
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'data_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'tanggal' => 'required',
            'asal_surat' => 'required|max:255',
            'perihal' => 'required|max:255',
            'lampiran' => 'required|max:255',
            'nomor_agenda' => 'required|max:255',
            'status' => '',
            'disposisi' => 'required',
            'file' => 'required|file|max:2400|mimes:pdf',
            'pass_id' => 'required|string'

        ]);

        if ($request->file('file')) {
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $fileContent = file_get_contents($filePath);

            // Encrypt the file content using AES encryption
            $encryptedContent = Crypt::encrypt($fileContent);

            // Define a storage path and filename
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = 'keuangan/' . $originalFileName . '.txt';

            Storage::put($fileName, $encryptedContent);

            // Save the path to the database
            $validatedData['file'] = $fileName;
        }

        Data::create($validatedData);
        Alert::success('Success', 'Tambah data berhasil !');
        return redirect('/surat-keluar');
    }

    public function createDataInformasi(Request $request)
    {
        $request->merge(['pass_id' => (string) 1]);
        // dd($request);
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'data_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'tanggal' => 'required',
            'asal_surat' => 'required|max:255',
            'perihal' => 'required|max:255',
            'lampiran' => 'required|max:255',
            'nomor_agenda' => 'required|max:255',
            'status' => '',
            'file' => 'required|file|max:2400|mimes:pdf',
            'pass_id' => 'required|string'
        ]);

        if ($request->file('file')) {
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $fileContent = file_get_contents($filePath);

            // Encrypt the file content using AES encryption
            $encryptedContent = Crypt::encrypt($fileContent);

            // Define a storage path and filename
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = 'data-informasi/' . $originalFileName . '.txt';

            Storage::put($fileName, $encryptedContent);

            // Save the path to the database
            $validatedData['file'] = $fileName;
        }

        // dd($validatedData);

        Data::create($validatedData);
        Alert::success('Success', 'Tambah data berhasil !');
        return redirect('/data-masuk');
    }




// public function createDataInformasi(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'divisi_id' => 'required',
//         'data_id' => 'required',
//         'nomor_surat' => 'required|max:255',
//         'judul' => 'required|max:255',
//         'tahun' => 'required|max:255',
//         'file' => 'required|file|max:2400|mimes:pdf',
//         'status' => '',
//         'pesan' => '',
//     ]);

//     if ($validator->fails()) {
//         return redirect('/data-masuk')
//                     ->withErrors($validator)
//                     ->withInput();
//     }

//     $fileContent = base64_encode(file_get_contents($request->file('file')->path()));

//     $fileName = $request->file('file')->getClientOriginalName();
//     $encodedFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.txt';
//     $filePath = 'data-informasi/' . $encodedFileName;
//     Storage::put($filePath, $fileContent);

//     $data = new Data();
//     $data->divisi_id = $request->divisi_id;
//     $data->data_id = $request->data_id;
//     $data->nomor_surat = $request->nomor_surat;
//     $data->judul = $request->judul;
//     $data->tahun = $request->tahun;
//     $data->file = $filePath;
//     // $data->status = $request->status;
//     // $data->pesan = $request->pesan;
//     $data->save();

//     Alert::success('Success Title', 'Tambah data berhasil !');
//     return redirect('/data-masuk');
// }

// public function show(Data $data)
// {
//     $fileContent = Storage::get($data->file);
//     $decodedContent = base64_decode($fileContent);

//     $tempFilePath = tempnam(sys_get_temp_dir(), 'decrypted_file_');
//     file_put_contents($tempFilePath, $decodedContent);

//     return response()->file($tempFilePath);
// }
 

    public function editDataInformasi(Data $data, Request $request)
    {
        $rules = [

            'divisi_id' => 'required',
            'data_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'judul' => 'required|max:255',
            'tahun' => 'required|max:255',
            'file' => 'file|max:2400|mimes:pdf',

        ];


        $validatedData = $request->validate($rules);

        if ($request->file('file')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file'] = $request->file('file')->store('data-informasi');
        }


        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Update data berhasil !');
        return redirect('/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function adminEditDataInformasi(Data $data, Request $request)
    {
        $rules = [

            'divisi_id' => 'required',
            'data_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'judul' => 'required|max:255',
            'tahun' => 'required|max:255',
            'status' => 'required',
            'pesan' => 'nullable'


        ];


        $validatedData = $request->validate($rules);


        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', ' data berhasil !');
        return redirect('/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function hapusDatainformasi(Data $data)
    {

        Data::destroy($data->id);
        Alert::success('Success', 'data berhasil di hapus !');
        return redirect('/data-masuk');
        // ->with('success', 'Data Berhasil di Hapus !')
    }
}

