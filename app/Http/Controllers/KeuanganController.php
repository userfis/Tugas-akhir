<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Divisi;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class KeuanganController extends Controller
{
    public function master(){

        $data = Data::where('divisi_id', '=', '2')
        ->whereNotIn('status', ['ditolak'])
        ->where(function ($query) {
            $search = request('search');
            $query->where('judul', 'like', "%" . $search . "%")
                ->orWhere('nomor_surat', 'like', "%" . $search . "%");
        })
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view('Keuangan.masterKeuangan',[

            'Halaman' => 'Keuangan',
            'data' => $data
        ]);
    }

    public function masuk(){
        
        $data = Data::where('divisi_id', '=', '2')
        ->where(function($query) {
            $query->where('status', '=', 'ditolak')
                  ->orWhereNull('status');
        })
        ->latest()
        ->get();
    
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
        Alert::success('Success', 'Tambah data berhasil !');
        return redirect('/keuangan/data-masuk');
        // ->with('success', 'Data berhasil di upload')
    }

    public function hapusKeuangan(Data $data)
    {

        Data::destroy($data->id);
        Alert::success('Success', 'Hapus data berhasil !');
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
        Alert::success('Success', 'Update data berhasil !');
        return redirect('/keuangan/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function adminEditKeuangan(Data $data, Request $request)
    {
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
        return redirect('/keuangan/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }


}
