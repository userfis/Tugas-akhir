<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Divisi;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class TeknisController extends Controller
{
    public function master(){

        $data = Data::where('divisi_id', '=', '3')
        ->whereNotIn('status', ['ditolak'])
        ->latest()
        ->get();

        return view('Teknis.masterTeknis',[

            'Halaman' => 'Teknis',
            'data' => $data
        ]);
    }

    public function masuk(){
        
        $data = Data::where('divisi_id', '=', '3')
        ->where(function($query) {
            $query->where('status', '=', 'ditolak')
                  ->orWhereNull('status');
        })
        ->latest()
        ->get();

        return view('Teknis.masukTeknis',[

            'data' => $data,
            'Halaman' => 'Teknis'
        ]);
    }

    public function viewTambah(){

        $data = Divisi::all();
        return view('Teknis.createTek',[
            'data' => $data
        ]);
    }

    public function viewEdit(Data $data){

        return view('Teknis.editTek',[
            'data' => $data,
            'divisi' => Divisi::all()
            // 'divisi' => Divisi::all()
        ]);

    }

    public function createTeknis(Request $request)
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
            $validatedData['file'] = $request->file('file')->store('data-teknis');
        }
        
        Data::create($validatedData);
        Alert::success('Success Title', 'Tambah data berhasil !');
        return redirect('/teknis/data-masuk');
    }

    public function editTeknis(Data $data, Request $request)
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
            $validatedData['file'] = $request->file('file')->store('data-teknis');
        }


        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Update data berhasil !');
        return redirect('/teknis/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function hapusDatateknis(Data $data)
    {

        Data::destroy($data->id);
        Alert::success('Success', 'data berhasil di hapus !');
        return redirect('/teknis/data-masuk');
        // ->with('success', 'Data Berhasil di Hapus !')
    }


    public function adminEditteknis(Data $data, Request $request)
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
        Alert::success('Success', 'Konfirmasi data berhasil !');
        return redirect('/teknis/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }



}
