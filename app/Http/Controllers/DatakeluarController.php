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


public function email(Request $request)
{
   
    $validatedData = $request->validate([
        'surat_id' => 'required',
        'email' => 'required|email|max:255',
        'deskripsi' => 'required',
        'password' => 'required' // Validasi password
    ]);

    $encryptedData = Data::findOrFail($validatedData['surat_id']);

    $passwordData = Enkrippass::findOrFail($encryptedData->pass_id);
    if (!Hash::check($request->password, $passwordData->password)) {
        Alert::error('Error Title', 'Password salah.');
        return redirect()->back();
    }

    $email = Email::create([
        'surat_id' => $validatedData['surat_id'],
        'email' => $validatedData['email'],
        'deskripsi' => $validatedData['deskripsi']
    ]);

    $encryptedContent = Storage::get($encryptedData->file);
    $decryptedContent = Crypt::decrypt($encryptedContent);

    $originalFileName = pathinfo($encryptedData->file, PATHINFO_FILENAME) . '.pdf';

    $tempFilePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $originalFileName;
    file_put_contents($tempFilePath, $decryptedContent);

    Mail::to($validatedData['email'])->send(new Kirimemail($encryptedData, $tempFilePath));

    unlink($tempFilePath);

    Alert::success('Success Title', 'Kirim data berhasil!');
    return back();
}


}
