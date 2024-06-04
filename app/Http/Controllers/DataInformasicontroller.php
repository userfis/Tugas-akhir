<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Email;
use App\Models\Divisi;
use App\Mail\Kirimemail;
use App\Models\Arsip;
use App\Models\Ketegori;
use App\Models\Rak;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DataInformasicontroller extends Controller
{
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

    public function show($id){
        $rak = Rak::find($id);
        return response()->json($rak);
    }

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

    public function editRak(Rak $rak){
        return view('dataInformasi.rak', [
            'rak' => $rak,
        ]);
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
        return redirect('/data-keluar');
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


// private function encryptData($data)
// {

//     $key = config('app.key'); 
//     $cipher = 'aes-256-cbc';
//     $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher)); 
//     $encryptedData = openssl_encrypt($data, $cipher, $key, 0, $iv);

//     return $encryptedData . '::' . base64_encode($iv);
// }

// public function show(Data $data)
// {
    
//    // Ambil konten file terenkripsi dari direktori
//    $encryptedContent = Storage::get($data->file);

//    // Dekripsi konten file
//    $decryptedContent = Crypt::decrypt($encryptedContent);

//    // Simpan konten terdekripsi ke dalam file sementara
//    $tempFilePath = tempnam(sys_get_temp_dir(), 'decrypted_file_');
//    file_put_contents($tempFilePath, $decryptedContent);

//    // Return response berupa file PDF yang telah didekripsi
//    return response()->file($tempFilePath); // Mengatur nama file // Mengatur nama file
// }

    // public function createDataInformasi(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'divisi_id' => 'required',
    //         'data_id' => 'required',
    //         'nomor_surat' => 'required|max:255',
    //         'judul' => 'required|max:255',
    //         'tahun' => 'required|max:255',
    //         'file' => 'required|file|max:2400|mimes:pdf',
    //         'status' => '',
    //         'pesan' => '',

    //     ]);
    //     if ($request->file('file')) {
    //         // Baca file ke dalam variabel
    //         $file = $request->file('file');

    //         // Baca konten file
    //         $fileContent = file_get_contents($file->path());

    //         // Enkripsi konten file menggunakan AES-128
    //         $encryptionKey = 'enkripsifile1234'; // Ganti dengan kunci enkripsi Anda
    //         $encryptedFileContent = openssl_encrypt($fileContent, 'aes-128-cbc', $encryptionKey, 0, $encryptionKey);

    //         // Konversi konten file terenkripsi ke format Base64
    //         $base64EncryptedFileContent = base64_encode($encryptedFileContent);

    //         // Simpan konten file terenkripsi dalam format Base64 ke penyimpanan
    //         $encryptedFileName = $file->getClientOriginalName() . '.enc';
    //         Storage::put('enkripsi-file/' . $encryptedFileName, $base64EncryptedFileContent);

    //         // Simpan nama file terenkripsi ke dalam array validatedData
    //         $validatedData['file'] = $encryptedFileName;
    //     }
    //     Data::create($validatedData);
    //     Alert::success('Success Title', 'Tambah data berhasil !');
    //     return redirect('/data-masuk');
    // }

    // public function decryptFile($id)
    // {
    //     // Temukan data file berdasarkan ID
    //     $fileData = Data::findOrFail($id); // Ganti FileModel dengan model Anda
    
    //     // Dapatkan nama file terenkripsi dari data file
    //     $encryptedFileName = $fileData->encrypted_file_name;
    
    //     // Baca file terenkripsi dari penyimpanan
    //     $encryptedFileContent = Storage::get('enkripsi-file/' . $encryptedFileName);
    
    //     // Dekode konten file dari Base64
    //     $encryptedFileContent = base64_decode($encryptedFileContent);
    
    //     // Dekripsi konten file menggunakan AES-128
    //     $encryptionKey = 'enkripsifile1234'; // Pastikan ini sesuai dengan kunci enkripsi Anda
    //     $decryptedFileContent = openssl_decrypt($encryptedFileContent, 'aes-128-cbc', $encryptionKey, 0, $encryptionKey);
    
    //     // Simpan file terdekripsi dalam penyimpanan atau kembalikan sebagai respons
    //     // Misalnya, simpan ke direktori yang diinginkan
    //     Storage::put('dekripsi-file/' . $encryptedFileName, $decryptedFileContent);
    
    //     // Atau kembalikan file terdekripsi sebagai respons
    //     return response()->streamDownload(function () use ($decryptedFileContent) {
    //         echo $decryptedFileContent;
    //     }, $encryptedFileName, ['Content-Type' => 'application/pdf']);
    // }
    

    //enkripsi file

    // public function editDataInformasi(Data $data, Request $request)
    // {
    //     $rules = [
    //         'file' => 'file|max:2400|mimes:pdf',
    //     ];

    //     $validatedData = $request->validate($rules);

    //     if ($request->file('file')) {
    //         // Baca file ke dalam variabel
    //         $file = $request->file('file');

    //         // Baca konten file
    //         $fileContent = file_get_contents($file->path());

    //         // Enkripsi konten file menggunakan AES-128
    //         $encryptionKey = 'enkripsifile1234'; // Ganti dengan kunci enkripsi Anda
    //         $encryptedFileContent = openssl_encrypt($fileContent, 'aes-128-cbc', $encryptionKey, 0, $encryptionKey);

    //         // Konversi konten file terenkripsi ke format Base64
    //         $base64EncryptedFileContent = base64_encode($encryptedFileContent);

    //         // Simpan konten file terenkripsi dalam format Base64 ke penyimpanan
    //         $encryptedFileName = $file->getClientOriginalName() . '.enc';
    //         Storage::put('enkripsi-file/' . $encryptedFileName, $base64EncryptedFileContent);

    //         // Simpan nama file terenkripsi ke dalam array validatedData
    //         $validatedData['file'] = $encryptedFileName;
    //     }

    //     // Update data dengan data terenkripsi
    //     $data->update($validatedData);

    //     Alert::success('Success', 'File berhasil dienkripsi dan disimpan!');
    //     return redirect('/data-masuk');
    // }
