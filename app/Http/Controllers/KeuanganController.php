<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Data;
use App\Models\Arsip;
use App\Models\Divisi;
use App\Models\Ketegori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class KeuanganController extends Controller
{
    public function Keluar(){

        $keu = Data::where('data_id', '=', '2')
        ->where('disposisi', '=', 'Staff Keuangan')
        ->latest()
        ->get();

        $huk = Data::where('data_id', '=', '2')
        ->where('disposisi', '=', 'Staff Hukum')
        ->latest()
        ->get();

        $data = Data::where('data_id', '=', '2')
        ->where('disposisi', '=', 'Staff Data & Informasi')
        ->latest()
        ->get();

        $tek = Data::where('data_id', '=', '2')
        ->where('disposisi', '=', 'Staff Teknis')
        ->latest()
        ->get();
        

        return view('Keuangan.suratKeluarStaff',[

            'Halaman' => 'Keuangan',
            'data' => $data,
            'keu' => $keu,
            'huk' => $huk,
            'tek' => $tek
        ]);
    }

    public function masuk(){
        
        $keu = Data::where('data_id', '=', '1')
        ->where('disposisi', '=', 'Staff Keuangan')
        ->latest()
        ->get();

        $huk = Data::where('data_id', '=', '1')
        ->where('disposisi', '=', 'Staff Hukum')
        ->latest()
        ->get();

        $data = Data::where('data_id', '=', '1')
        ->where('disposisi', '=', 'Staff Data & Informasi')
        ->latest()
        ->get();

        $tek = Data::where('data_id', '=', '1')
        ->where('disposisi', '=', 'Staff Teknis')
        ->latest()
        ->get();
    
        return view('Keuangan.masukStaff',[

            'data' => $data,
            'keu' => $keu,
            'huk' => $huk,
            'tek' => $tek,
            'Halaman' => 'Keuangan'
        ]);
    }

    public function viewTambah(){

        $data = Divisi::all();
        $kategori = Ketegori::all();
        return view('Keuangan.createKeluarStaff',[
            'data' => $data,
            'kategori' => $kategori
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
         dd($validatedData);

        if ($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('keuangan');
        }
        
        Data::create($validatedData);
        Alert::success('Success', 'Tambah data berhasil !');
        return redirect('/keuangan/master-data');
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

        $arsip = Arsip::where('surat_id', $data->id)->first();
        return view('Keuangan.konfirmSM',[
            'data' => $data,
            'rak' =>Rak::all(),
            'arsip' =>$arsip
        ]);

    }

    public function konfirmSM(Data $data, Request $request)
    {
        $rules = [
            'surat_id' => 'required|max:255',
            'tanggal_arsip' => 'required',
            'rak_id' => 'required|max:255'
        ];
       
        $validatedData = $request->validate($rules);
        
        Arsip::create($validatedData);
        Alert::success('Success', 'Update data berhasil !');
        return redirect('/staff/surat-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function terimaSM(Data $data, Request $request)
    {
        // dd($request);
        $rules = [

            'status' => 'required|max:255',

        ];

        
        $validatedData = $request->validate($rules);
        
        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Surat Telah Diterima !');
        return redirect('/staff/surat-masuk');
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
