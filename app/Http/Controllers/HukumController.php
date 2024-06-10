<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Data;
use App\Models\Arsip;
use App\Models\Divisi;
use App\Models\Ketegori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\LengthAwarePaginator;

class HukumController extends Controller
{

    public function searchSKPim(Request $request)
    {
        $searchQuery = $request->input('query');
    
        $ket = Data::where('data_id', '2')
            ->where('disposisi', 'Ketua KPU')
            ->where(function ($query) use ($searchQuery) {
                $query->where('nomor_surat', 'like', "%$searchQuery%")
                    ->orWhere('perihal', 'like', "%$searchQuery%");
            })
            ->latest()
            ->paginate(5);
    
        $sek = Data::where('data_id', '2')
            ->where('disposisi', 'Sekretaris')
            ->where(function ($query) use ($searchQuery) {
                $query->where('nomor_surat', 'like', "%$searchQuery%")
                    ->orWhere('perihal', 'like', "%$searchQuery%");
            })
            ->latest()
            ->paginate(5);
    
        return view('Hukum.suratKeluarPim', [
            'ket' => $ket,
            'sek' => $sek,
            'Halaman' => 'Keuangan'
        ]);
    }


    public function keluar(){

        $sek = Data::where('data_id', '=', '2')
        ->where('disposisi', '=', 'Sekretaris')
        ->latest()
        ->paginate(10);

        $ket =Data::where('data_id', '=', '2')
        ->where('disposisi', '=', 'Ketua KPU')
        ->latest()
        ->paginate(10);

        return view('Hukum.suratKeluarPim',[

            'Halaman' => 'Hukum',
            'sek' => $sek,
            'ket' => $ket,
            
        ]);
    }

    public function searchSMPim(Request $request)
    {
        $searchQuery = $request->input('query');
    
        $ket = Data::where('data_id', '1')
            ->where('disposisi', 'Ketua KPU')
            ->where(function ($query) use ($searchQuery) {
                $query->where('nomor_surat', 'like', "%$searchQuery%")
                    ->orWhere('perihal', 'like', "%$searchQuery%");
            })
            ->latest()
            ->paginate(5);
    
        $sek = Data::where('data_id', '1')
            ->where('disposisi', 'Sekretaris')
            ->where(function ($query) use ($searchQuery) {
                $query->where('nomor_surat', 'like', "%$searchQuery%")
                    ->orWhere('perihal', 'like', "%$searchQuery%");
            })
            ->latest()
            ->paginate(5);
    
        return view('Hukum.masukPim', [
            'ket' => $ket,
            'sek' => $sek,
            'Halaman' => 'Keuangan'
        ]);
    }

    public function masuk(){
        
        $sek = Data::where('data_id', '=', '1')
        ->where('disposisi', '=', 'Sekretaris')
        ->latest()
        ->paginate(5);

        $ket =Data::where('data_id', '=', '1')
        ->where('disposisi', '=', 'Ketua KPU')
        ->latest()
        ->paginate(5);

        return view('Hukum.masukPim',[

            'sek' => $sek,
            'ket' => $ket,
            'Halaman' => 'Hukum'
        ]);
    }

    public function cekSM(){
        
        $sek = Data::where('data_id', '=', '1')
        ->where('status', '=', 'Proses Pengecekan')
        ->latest()
        ->paginate(10);

        $ket =Data::where('data_id', '=', '1')
        ->where('status', '=', 'Diajukan')
        ->latest()
        ->paginate(10);

        return view('Hukum.cekSM',[

            'sek' => $sek,
            'ket' => $ket,
            'Halaman' => 'Hukum'
        ]);
    }

    public function cekSK() {
        $sek = Data::where('data_id', '=', '2')
            ->where('status', '=', 'Proses Pengecekan')
            ->latest()
            ->paginate(10);
    
        $ket = Data::where('data_id', '=', '2')
            ->where('status', '=', 'Diajukan')
            ->latest()
            ->paginate(10);
    
        return view('Hukum.cekSK', [
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

    public function viewKonfirm(Data $data){

        return view('Hukum.editSM',[
            'data' => $data,
            'divisi' => Divisi::all()
            // 'divisi' => Divisi::all()
        ]);

    }

    public function viewKonfirmSK(Data $data){

        return view('Hukum.editSK',[
            'data' => $data,
            'divisi' => Divisi::all()
            // 'divisi' => Divisi::all()
        ]);

    }

    public function konfirmSK(Data $data, Request $request)
    {
        $rules = [

            'status' => 'required|max:255',
            'tindakan' => 'required|max:255',


        ];

        
        $validatedData = $request->validate($rules);
        
        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Surat Berhasil Diajukan !');
        return redirect('/cek-surat-keluar');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function konfirmSM(Data $data, Request $request)
    {
        // dd($request);
        $rules = [

            'status' => 'required|max:255',
            'tindakan' => 'required|max:255',
            'pesan' => ''

        ];

        
        $validatedData = $request->validate($rules);
        
        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Surat Berhasil di Konfirmasi !');
        return redirect('/cek-surat-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function terimaSMP(Data $data, Request $request)
    {
        // dd($request);
        $rules = [

            'status' => 'required|max:255',

        ];

        
        $validatedData = $request->validate($rules);
        
        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Surat Telah Diterima !');
        return redirect('/pimpinan/surat-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function viewEdit(Data $data){

        $arsip = Arsip::where('surat_id', $data->id)->first();
        return view('Hukum.konfirmSMP',[
            'data' => $data,
            'rak' =>Rak::all(),
            'arsip' =>$arsip
        ]);

    }

    public function arsipSM(Data $data, Request $request)
    {
        $rules = [
            'surat_id' => 'required|max:255',
            'tanggal_arsip' => 'required',
            'rak_id' => 'required|max:255'
        ];
       
        $validatedData = $request->validate($rules);
        
        Arsip::create($validatedData);
        Alert::success('Success', 'Update data berhasil !');
        return redirect('/pimpinan/surat-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function konfirmSKP(Data $data, Request $request)
    {
        // dd($request);
        $rules = [

            'status' => 'required|max:255',
            'tindakan' => 'required|max:255',
            'pesan' => 'required|max:255',

        ];

        
        $validatedData = $request->validate($rules);
        
        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Surat Berhasil di Konfirmasi !');
        return redirect('/cek-surat-keluar');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function konfirmSMP(Data $data, Request $request)
    {
        // dd($request);
        $rules = [

            'status' => 'required|max:255',
            'disposisi' => 'required|max:255',
            'pesan' => 'required|max:255',

        ];

        
        $validatedData = $request->validate($rules);
        
        Data::where('id', $data->id)->update($validatedData);
        Alert::success('Success', 'Surat Berhasil Didisposisi !');
        return redirect('/cek-surat-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function createKeluar(Request $request)
    {
        $request->merge(['pass_id' => (string) 1]);
        // dd($request);
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
            'pass_id' => 'required|string'
        ]);

        if ($request->file('file')) {
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $fileContent = file_get_contents($filePath);

            // Encrypt the file content using AES encryption
            $encryptedContent = Crypt::encrypt($fileContent);

            // Define a storage path and filename
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = 'data-hukum/' . $originalFileName . '.txt';

            Storage::put($fileName, $encryptedContent);

            // Save the path to the database
            $validatedData['file'] = $fileName;
        }

        Data::create($validatedData);
        Alert::success('Success', 'Tambah data berhasil !');
        return redirect('/staff/surat-keluar');
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
