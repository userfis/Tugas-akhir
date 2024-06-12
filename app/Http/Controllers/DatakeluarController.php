<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Email;
use App\Models\Divisi;
use App\Mail\Kirimemail;
use App\Models\Enkrippass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DatakeluarController extends Controller
{
    public function dataKeluar()
    {

        return view('dataKeluar', [
            'data' => Email::all()
        ]);
    }

    public function kirimData(Data $data)
    {

        return view('dataInformasi.kirimData', [
            'data' => $data,
            'divisi' => Divisi::all()
            // 'divisi' => Divisi::all()
        ]);
    }

    // public function email(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'surat_id' => 'required',
    //         'email' => 'required|email|max:255',
    //         'deskripsi' => 'required'
    //     ]);

        // $email = Email::create([
        //     'surat_id' => $validatedData['surat_id'],
        //     'email' => $validatedData['email'],
        //     'deskripsi' => $validatedData['deskripsi']
        // ]);

    //     Mail::to($validatedData['email'])->send(new Kirimemail($email));


    //     Alert::success('Success Title', 'Kirim data berhasil !');
    //     return redirect('/master-data');
    // }

//     public function email(Request $request)
// {
//     // Validasi input dari form
//     $validatedData = $request->validate([
//         'surat_id' => 'required',
//         'email' => 'required|email|max:255',
//         'deskripsi' => 'required',
//         'status' => 'required',
//         // 'password' => 'required' // Jangan lupa tambahkan validasi password
//     ]);

//          $email = Email::create([
//             'surat_id' => $validatedData['surat_id'],
//             'email' => $validatedData['email'],
//             'deskripsi' => $validatedData['deskripsi']
//         ]);

//     // Mendapatkan data terenkripsi berdasarkan surat_id
//     $encryptedData = Data::findOrFail($validatedData['surat_id']);

//     // dd($encryptedData);

//     // Dekripsi file
//     $encryptedContent = Storage::get($encryptedData->file);
//     $decryptedContent = Crypt::decrypt($encryptedContent);

//     // Simpan file terdekripsi ke dalam file sementara
//     $tempFilePath = tempnam(sys_get_temp_dir(), 'decrypted_file_') . '.pdf';
//     file_put_contents($tempFilePath, $decryptedContent);

//     // Kirim email dengan menggunakan Mail::to dan lampirkan file terdekripsi
//     Mail::to($validatedData['email'])->send(new Kirimemail($encryptedData, $tempFilePath));

//     // Hapus file sementara setelah email terkirim
//     unlink($tempFilePath);

//     // Tampilkan pesan sukses dan redirect
//     Alert::success('Success Title', 'Kirim data berhasil !');
//     return redirect('/surat-keluar');

// }    
// }

// public function email(Request $request)
// {
//     // dd($request->all());
//     // Validasi input dari form
//     $validatedData = $request->validate([
//         'surat_id' => 'required',
//         'email' => 'required|email|max:255',
//         'deskripsi' => 'required',
//         // 'status' => 'required',
//         'password' => 'required' // Validasi password
//     ]);

//     // Mendapatkan data terenkripsi berdasarkan surat_id
//     $encryptedData = Data::findOrFail($validatedData['surat_id']);

//     // Validasi password
//     $passwordData = Enkrippass::findOrFail($encryptedData->pass_id);
//     if (!Hash::check($request->password, $passwordData->password)) {
//         // Password tidak valid
//         Alert::error('Error Title', 'Password salah.');
//         return redirect()->back();
//     }

//     // Buat entri Email baru
//     $email = Email::create([
//         'surat_id' => $validatedData['surat_id'],
//         'email' => $validatedData['email'],
//         'deskripsi' => $validatedData['deskripsi']
//     ]);

//     // Dekripsi file
//     $encryptedContent = Storage::get($encryptedData->file);
//     $decryptedContent = Crypt::decrypt($encryptedContent);

//     // Simpan file terdekripsi ke dalam file sementara
//     $tempFilePath = tempnam(sys_get_temp_dir(), 'decrypted_file_') . '.pdf';
//     file_put_contents($tempFilePath, $decryptedContent);

//     // Kirim email dengan menggunakan Mail::to dan lampirkan file terdekripsi
//     Mail::to($validatedData['email'])->send(new Kirimemail($encryptedData, $tempFilePath));

//     // Hapus file sementara setelah email terkirim
//     unlink($tempFilePath);

//     // Tampilkan pesan sukses dan redirect
//     Alert::success('Success Title', 'Kirim data berhasil !');
//     return redirect('/surat-keluar');
// }

public function email(Request $request)
{
    // Validasi input dari form
    $validatedData = $request->validate([
        'surat_id' => 'required',
        'email' => 'required|email|max:255',
        'deskripsi' => 'required',
        'password' => 'required' // Validasi password
    ]);

    // Mendapatkan data terenkripsi berdasarkan surat_id
    $encryptedData = Data::findOrFail($validatedData['surat_id']);

    // Validasi password
    $passwordData = Enkrippass::findOrFail($encryptedData->pass_id);
    if (!Hash::check($request->password, $passwordData->password)) {
        // Password tidak valid
        Alert::error('Error Title', 'Password salah.');
        return redirect()->back();
    }

    // Buat entri Email baru
    $email = Email::create([
        'surat_id' => $validatedData['surat_id'],
        'email' => $validatedData['email'],
        'deskripsi' => $validatedData['deskripsi']
    ]);

    // Dekripsi file
    $encryptedContent = Storage::get($encryptedData->file);
    $decryptedContent = Crypt::decrypt($encryptedContent);

    // Dapatkan nama file asli
    $originalFileName = pathinfo($encryptedData->file, PATHINFO_FILENAME) . '.pdf';

    // Simpan file terdekripsi ke dalam file sementara dengan nama asli
    $tempFilePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $originalFileName;
    file_put_contents($tempFilePath, $decryptedContent);

    // Kirim email dengan menggunakan Mail::to dan lampirkan file terdekripsi
    Mail::to($validatedData['email'])->send(new Kirimemail($encryptedData, $tempFilePath));

    // Hapus file sementara setelah email terkirim
    unlink($tempFilePath);

    // Tampilkan pesan sukses dan redirect
    Alert::success('Success Title', 'Kirim data berhasil!');
    return redirect('/surat-keluar');
}


}
