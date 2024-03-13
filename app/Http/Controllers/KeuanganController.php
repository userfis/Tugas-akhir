<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Divisi;
use Illuminate\Support\Facades\Storage;

class KeuanganController extends Controller
{
    public function master(){

        return view('Keuangan.masterKeuangan',[

            'Halaman' => 'Keuangan'
        ]);
    }

    public function masuk(){
        
        $data = Data::where('divisi_id', '=', '2')
        ->latest()->get();
        // $data = Data::all();
        return view('Keuangan.masukKeuangan',[

            'data' => $data,
            'Halaman' => 'Keuangan'
        ]);
    }

    public function viewTambah(){

        $data = Divisi::all();
        return view('Keuangan.createKeu',[
            'data' => $data
        ]);
    }

    public function createKeuangan(Request $request)
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
            $validatedData['file'] = $request->file('file')->store('keuangan');
        }
        
        Data::create($validatedData);
        return redirect('/keuangan/data-masuk');
        // ->with('success', 'Data berhasil di upload')
    }

    public function hapusKeuangan(Data $data)
    {

        Data::destroy($data->id);

        return redirect('/keuangan/data-masuk');
        // ->with('success', 'Data Berhasil di Hapus !')
    }

    public function viewEdit(Data $data){

        return view('Keuangan.editKeu',[
            'data' => $data,
            'divisi' => Divisi::all()
            // 'divisi' => Divisi::all()
        ]);

    }

    public function editKeuangan(Data $data, Request $request)
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
            $validatedData['file'] = $request->file('file')->store('keuangan');
        }


        Data::where('id', $data->id)->update($validatedData);

        return redirect('/keuangan/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

}
