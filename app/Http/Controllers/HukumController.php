<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Divisi;
use App\Models\Ketegori;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class HukumController extends Controller
{
    public function keluar(){

        $sek = Data::where('data_id', '=', '2')
        ->where('disposisi', '=', 'Sekretaris')
        ->latest()
        ->get();

        $ket =Data::where('data_id', '=', '2')
        ->where('disposisi', '=', 'Ketua KPU')
        ->latest()
        ->get();

        return view('Hukum.suratKeluarPim',[

            'Halaman' => 'Hukum',
            'sek' => $sek,
            'ket' => $ket,
            
        ]);
    }

    public function masuk(){
        
        $sek = Data::where('data_id', '=', '1')
        ->where('disposisi', '=', 'Sekretaris')
        ->latest()
        ->get();

        $ket =Data::where('data_id', '=', '1')
        ->where('disposisi', '=', 'Ketua KPU')
        ->latest()
        ->get();

        return view('Hukum.masukPim',[

            'sek' => $sek,
            'ket' => $ket,
            'Halaman' => 'Hukum'
        ]);
    }

    public function viewTambah(){

        $data = Divisi::all();
        $kategori = Ketegori::all();

        return view('Hukum.createKeluar',[
            'data' => $data,
            'kategori' => $kategori
        ]);
    }

    public function viewEdit(Data $data){

        return view('Hukum.editHuk',[
            'data' => $data,
            'divisi' => Divisi::all()
            // 'divisi' => Divisi::all()
        ]);

    }

    public function createKeluar(Request $request)
    {
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

        ]);
        // dd($validatedData);

        if ($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('data-hukum');
        }
        
        Data::create($validatedData);
        Alert::success('Success Title', 'Tambah data berhasil !');
        return redirect('/hukum/master-data');
    }

    public function editHukum(Data $data, Request $request)
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
            $validatedData['file'] = $request->file('file')->store('data-hukum');
        }


        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Update data berhasil !');
        return redirect('/hukum/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function hapusDatahukum(Data $data)
    {

        Data::destroy($data->id);
        Alert::success('Success', 'data berhasil di hapus !');
        return redirect('/hukum/data-masuk');
        // ->with('success', 'Data Berhasil di Hapus !')
    }

    public function adminEdithukum(Data $data, Request $request)
    {
        // dd($request->all());
        $rules = [

            'nomor_surat' => 'required|max:255',
            'judul' => 'required|max:255',
            'tahun' => 'required|max:255',
            'divisi_id' => 'required',
            'data_id' => 'required',
            'status' => 'required',
            'pesan' => 'nullable'

        ];

        
        $validatedData = $request->validate($rules);
       
        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Update data berhasil !');
        return redirect('/hukum/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }


}
