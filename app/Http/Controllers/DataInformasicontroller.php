<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Email;
use App\Models\Divisi;
use App\Mail\Kirimemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DataInformasicontroller extends Controller
{
    public function master(){

        $data = Data::where('divisi_id', '=', '1')
        ->whereNotIn('status', ['ditolak'])
        ->latest()
        ->get();

        return view('dataInformasi.master',[

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }
    public function masuk(){
        
        $data = Data::where('divisi_id', '=', '1')
        ->where(function($query) {
            $query->where('status', '=', 'ditolak')
                  ->orWhereNull('status');
        })
        ->latest()
        ->get();
        // $data = Data::where('divisi_id', '=', '1')
        // ->latest()->get();
        // $data = Data::all();
        return view('dataInformasi.masuk',[

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function viewTambah(){

        $data = Divisi::all();
        return view('dataInformasi.tambahdata',[
            'data' => $data
        ]);
    }

    public function viewEdit(Data $data){

        return view('dataInformasi.editData',[
            'data' => $data,
            'divisi' => Divisi::all()
            // 'divisi' => Divisi::all()
        ]);

    }

    public function createDataInformasi(Request $request)
    {
        $validatedData = $request->validate([
            'divisi_id' => 'required',
            'data_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'judul' => 'required|max:255',
            'tahun' => 'required|max:255',
            'file' => 'required|file|max:2400|mimes:pdf',
            'status' => '',
            'pesan' => '',

        ]);
        // dd($validatedData);

        if ($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('data-informasi');
        }
        
        Data::create($validatedData);
        Alert::success('Success Title', 'Tambah data berhasil !');
        return redirect('/data-masuk');
    }

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

    public function kirimData(Data $data){

        return view('dataInformasi.kirimData',[
            'data' => $data,
            'divisi' => Divisi::all()
            // 'divisi' => Divisi::all()
        ]);

    }

//     public function email(Request $request){

//      $validatedData = $request->validate([
//         'surat_id' => 'required',
//         'email' => 'required|email|max:255',
//         'deskripsi' => 'required|max:255'
//     ]);

//     // Kirim email
//     Mail::to($validatedData['email'])->send(new Kirimemail($validatedData));

//     // Simpan data baru pada model Email
//     Email::create([
//         'surat_id' => $validatedData['surat_id'],
//         'email' => $validatedData['email'],
//         'deskripsi' => $validatedData['deskripsi']
//     ]);

//     // Email::create($validatedData);

    
//     Alert::success('Success Title', 'Tambah data berhasil !');
//     return redirect('/master-data');
// }

public function email(Request $request)
{
    $validatedData = $request->validate([
        'surat_id' => 'required',
        'email' => 'required|email|max:255',
        'deskripsi' => 'required|max:255'
    ]);

    $email = Email::create([
        'surat_id' => $validatedData['surat_id'],
        'email' => $validatedData['email'],
        'deskripsi' => $validatedData['deskripsi']
    ]);

    // Kirim email
    Mail::to($validatedData['email'])->send(new Kirimemail($email));

    // Tambahkan relasi jika diperlukan
    // $email->surat()->associate($suratId); // Misalnya jika $suratId adalah ID dari Surat

    Alert::success('Success Title', 'Tambah data berhasil !');
    return redirect('/master-data');
}


}
