<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Email;
use App\Models\Divisi;
use App\Mail\Kirimemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    //     $email = Email::create([
    //         'surat_id' => $validatedData['surat_id'],
    //         'email' => $validatedData['email'],
    //         'deskripsi' => $validatedData['deskripsi']
    //     ]);

    //     Mail::to($validatedData['email'])->send(new Kirimemail($email));


    //     Alert::success('Success Title', 'Kirim data berhasil !');
    //     return redirect('/master-data');
    // }

    public function email(Request $request)
{
    $validatedData = $request->validate([
        'surat_id' => 'required',
        'email' => 'required|email|max:255',
        'deskripsi' => 'required',
        'status' => 'required' // aturan validasi untuk status
    ]);

    $email = Email::create([
        'surat_id' => $validatedData['surat_id'],
        'email' => $validatedData['email'],
        'deskripsi' => $validatedData['deskripsi']
    ]);

    // Lakukan pembaruan pada field status
    $data = Data::findOrFail($validatedData['surat_id']);
    $data->update([
        'status' => $validatedData['status']
    ]);

    Mail::to($validatedData['email'])->send(new Kirimemail($email));

    Alert::success('Success Title', 'Kirim data berhasil !');
    return redirect('/master-data');
}
}
