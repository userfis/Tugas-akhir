<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Divisi;
use Illuminate\Http\Request;

class DataInformasicontroller extends Controller
{
    public function master(){

        return view('dataInformasi.master');
    }
    public function masuk(){
        
        $data = Data::where('divisi_id', '=', '1')
        ->latest()->get();
        // $data = Data::all();
        return view('dataInformasi.masuk',[
            'data' => $data
        ]);
    }
    public function viewTambah(){

        $data = Divisi::all();
        return view('dataInformasi.tambahdata',[
            'data' => $data
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
        return redirect('/data-masuk');
        // ->with('success', 'Data berhasil di upload')
    }

    public function hapusDatainformasi(Data $data)
    {

        Data::destroy($data->id);

        return redirect('/data-masuk');
        // ->with('success', 'Data Berhasil di Hapus !')
    }
}
