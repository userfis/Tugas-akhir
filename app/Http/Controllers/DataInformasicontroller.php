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
use Illuminate\Support\Str;

class DataInformasicontroller extends Controller
{
    public function master()
    {

        $data = Data::where('divisi_id', '=', '1')
            ->whereNotIn('status', ['ditolak'])
            ->where(function ($query) {
                $search = request('search');
                $query->where('judul', 'like', "%" . $search . "%")
                    ->orWhere('nomor_surat', 'like', "%" . $search . "%");
            })
            ->orderBy('updated_at', 'DESC')
            ->get();


        return view('dataInformasi.master', [

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }
    public function masuk()
    {

        $data = Data::where('divisi_id', '=', '1')
            ->where(function ($query) {
                $query->where('status', '=', 'ditolak')
                    ->orWhereNull('status');
            })
            ->latest()
            ->get();
        // $data = Data::where('divisi_id', '=', '1')
        // ->latest()->get();
        // $data = Data::all();
        return view('dataInformasi.masuk', [

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function viewTambah()
    {

        $data = Divisi::all();
        return view('dataInformasi.tambahdata', [
            'data' => $data
        ]);
    }

    public function viewEdit(Data $data)
    {

        return view('dataInformasi.editData', [
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

    //enkripsi file

    public function editDataInformasi(Data $data, Request $request)
    {
        $rules = [
            'file' => 'file|max:2400|mimes:pdf',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('file')) {
            // Baca file ke dalam variabel
            $file = $request->file('file');

            // Baca konten file
            $fileContent = file_get_contents($file->path());

            // Enkripsi konten file menggunakan AES-128
            $encryptionKey = 'enkripsifile1234'; // Ganti dengan kunci enkripsi Anda
            $encryptedFileContent = openssl_encrypt($fileContent, 'aes-128-cbc', $encryptionKey, 0, $encryptionKey);

            // Konversi konten file terenkripsi ke format Base64
            $base64EncryptedFileContent = base64_encode($encryptedFileContent);

            // Simpan konten file terenkripsi dalam format Base64 ke penyimpanan
            $encryptedFileName = $file->getClientOriginalName() . '.enc';
            Storage::put('enkripsi-file/' . $encryptedFileName, $base64EncryptedFileContent);

            // Simpan nama file terenkripsi ke dalam array validatedData
            $validatedData['file'] = $encryptedFileName;
        }

        // Update data dengan data terenkripsi
        $data->update($validatedData);

        Alert::success('Success', 'File berhasil dienkripsi dan disimpan!');
        return redirect('/data-masuk');
    }

    // public function editDataInformasi(Data $data, Request $request)
    // {
    //     $rules = [
    //         'file' => 'file|max:2400|mimes:pdf',
    //     ];

    //     $validatedData = $request->validate($rules);

    //     if ($request->file('file')) {
    //         // Baca file ke dalam variabel
    //         $file = $request->file('file');

    //         // Baca konten file
    //         $fileContent = file_get_contents($file->path());

    //         // Konversi konten file ke dalam format Base64
    //         $base64FileContent = base64_encode($fileContent);

    //         // Simpan konten file dalam format Base64 ke penyimpanan
    //         $base64FileName = Str::random(40) . '.txt'; // Atur ekstensi file sesuai kebutuhan
    //         Storage::put('enkripsi-file/' . $base64FileName, $base64FileContent);

    //         // Simpan nama file dalam format Base64 ke dalam array validatedData
    //         $validatedData['file'] = $base64FileName;
    //     }

    //     // Update data dengan data terenkripsi
    //     $data->update($validatedData);

    //     Alert::success('Success', 'Update data berhasil !');
    //     return redirect('/data-masuk');
    // }

    // public function editDataInformasi(Data $data, Request $request)
    // {
    //     $rules = [

    //         'divisi_id' => 'required',
    //         'data_id' => 'required',
    //         'nomor_surat' => 'required|max:255',
    //         'judul' => 'required|max:255',
    //         'tahun' => 'required|max:255',
    //         'file' => 'file|max:2400|mimes:pdf',

    //     ];


    //     $validatedData = $request->validate($rules);

    //     if ($request->file('file')) {
    //         if ($request->oldFile) {
    //             Storage::delete($request->oldFile);
    //         }
    //         $validatedData['file'] = $request->file('file')->store('data-informasi');
    //     }


    //     Data::where('id', $data->id)->update($validatedData);
    //     Alert::success('Success', 'Update data berhasil !');
    //     return redirect('/data-masuk');
    //     // ->with('success', 'Artikel Berhasil Di Update!')

    // }

    // public function download(Data $data)
    // {
    //     // Lakukan proses download file
    //     $file = public_path('storage/' . $data->file); // Misalnya file disimpan di dalam direktori storage/app

    //     return response()->download($file);
    // }

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
}
