<?php

namespace App\Http\Controllers;

use PDF;
use Dompdf\Dompdf;
use App\Models\Rak;
use Dompdf\Options;
use App\Models\Data;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Email;
use App\Models\Divisi;
use App\Mail\Kirimemail;
use App\Models\Ketegori;
use App\Models\Enkrippass;
use Illuminate\Support\Str;
use App\Exports\ArsipExport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DataInformasicontroller extends Controller
{
    public function enkripPass(){

        return view('dataInformasi.enkripPass', [
            'pass' => Enkrippass::all(),
            'halaman' => 'Daftar Password Dekripsi File'
        ]);

    }

    public function editPassDekripsi(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'old_password.required' => 'Password lama tidak boleh kosong.',
            'password.required' => 'Password baru tidak boleh kosong.',
            'password.min' => 'Password baru minimal :min karakter.',
            'confirm_password.required' => 'Konfirmasi password baru tidak boleh kosong.',
            'confirm_password.same' => 'Konfirmasi password baru harus sama dengan password baru.'
        ]);
    
        if ($validator->fails()) {
            Alert::error('Error', 'Ada kesalahan pada input Anda')->persistent(true);
            return back()->withErrors($validator)->withInput();
        }
    
        $pass = Enkrippass::findOrFail($id);
    
        if (!Hash::check($request->old_password, $pass->password)) {
            Alert::error('Error', 'Password lama tidak cocok.')->persistent(true);
            return back()->withErrors(['old_password' => 'Password lama tidak cocok'])->withInput();
        }
    
        $pass->password = Hash::make($request->password);
        $pass->save();
    
        Alert::success('Success', 'Password berhasil diperbarui!');
        return back()->with('success', 'Password berhasil diperbarui');
    }

    public function createUser(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'is_admin' => 'required',

        ],[
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);
        Alert::success('Success Title', 'Tambah User Berhasil !');
        return redirect('/data-user');
    }

    public function tambahUser(){
        return view('dataInformasi.tambahUser', [

            'Halaman' => 'Daftar Data User',
            'data' => User::all()
        ]); 
    }

    public function editUser(User $user){
        return view('dataInformasi.editUser', [

            'Halaman' => 'Daftar Data User',
            'user' => $user
        ]); 
    }

    public function deleteUser(User $user){

        User::destroy($user->id);
        Alert::success('Success', 'User berhasil di hapus !');
        return back();
    }


    public function updateUser(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => 'required|string|max:255',
            'is_admin' => 'required',
        ]);
    
        if ($request->filled('password')) {
            $request->validate([
                'current_password' => 'required|string',
                'password' => 'nullable|string|min:6|confirmed',
            ], [
                'current_password.required' => 'Kolom password lama harus diisi jika ingin mengubah password.',
                'password.min' => 'Password baru harus terdiri dari minimal :min karakter.',
                'password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
            ]);
    
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
    
            $user->password = Hash::make($request->password);
        }
    
        // Update data pengguna
        $user->nama = $validatedData['nama'];
        $user->email = $validatedData['email'];
        $user->username = $validatedData['username'];
        $user->is_admin = $validatedData['is_admin'];
        $user->save();
    
        // Redirect dengan pesan sukses
        Alert::success('Success Title', 'Update User Berhasil !');
        return redirect('/data-user');
    }
    

    public function user(){

        return view('dataInformasi.dataUser', [

            'Halaman' => 'Daftar Data User',
            'user' => User::paginate(10)
        ]); 
    }

    public function searchDisposisi(Request $request)
    {
        $query = $request->input('query');
    
         $data = Data::where('data_id', '=', '1')  // Pastikan kondisi ini sesuai dengan kebutuhan Anda
        ->where(function($q) use ($query) {
            $q->where('nomor_surat', 'like', "%{$query}%")
              ->orWhere('perihal', 'like', "%{$query}%");
        })
        ->where(function($q) {
            $q->where('status', '=', 'Disposisi')
              ->orWhere('status', '=', 'Selesai Disposisi');
        })
        ->latest()
        ->paginate(10);
    
        return view('dataInformasi.disposisi', [
            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function disposisi(){
        $data = Data::where('status', '=', 'Disposisi')
        ->orWhere('status', '=', 'Selesai Disposisi')
        ->latest()
        ->paginate(10);

        return view('dataInformasi.disposisi', [

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);

    }

    public function searchSK(Request $request)
    {
        $query = $request->input('query');
        
        $data = Data::where('data_id', '=', '2')
            ->where(function($q) use ($query) {
                $q->where('nomor_surat', 'like', "%{$query}%")
                  ->orWhere('perihal', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(10);

        return view('dataInformasi.keluar', [
            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function keluar()
    {

        $data = Data::where('data_id', '=', '2')
        ->latest()
        ->paginate(10);


        return view('dataInformasi.keluar', [

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $data = Data::where('data_id', '=', '1')
            ->where(function($q) use ($query) {
                $q->where('nomor_surat', 'like', "%{$query}%")
                  ->orWhere('perihal', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(10);

        return view('dataInformasi.masuk', [
            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function masuk()
    {

       $data = Data::where('data_id', '=', '1')
       ->latest()
       ->paginate(10);
        return view('dataInformasi.masuk', [

            'Halaman' => 'Data & Informasi',
            'data' => $data
        ]);
    }

    public function searchArsip(Request $request){

    $search = $request->input('query'); // Pastikan ini sesuai dengan nama input di form pencarian

    $arsip = Data::with(['arsip.rak'])
        ->where('data_id', '1')
        ->whereHas('arsip', function ($query) use ($search) {
            if ($search) {
                $query->where('nomor_surat', 'like', "%{$search}%")
                      ->orWhere('perihal', 'like', "%{$search}%")
                      ->orWhere('asal_surat', 'like', "%{$search}%");
            }
        })
        ->latest()
        ->paginate(10);

        // dd($request->all(), $arsip);

    // dd($request->all(),$arsip);

    return view('dataInformasi.arsip', [
        'Halaman' => 'Data & Informasi',
        'arsip' => $arsip
    ]);

    }
    public function arsip()
    {


        $arsip = Data::with(['arsip.rak'])
        ->where('data.data_id', '1')
        ->whereHas('arsip.rak', function ($query) {
        })
        ->latest()
        ->paginate(10);


        return view('dataInformasi.arsip', [

            'Halaman' => 'Data & Informasi',
            'arsip' => $arsip
        ]);
    }

    public function searchArsipSK(Request $request){

        $search = $request->input('query'); // Pastikan ini sesuai dengan nama input di form pencarian

        $arsip = Data::with(['arsip.rak'])
            ->where('data_id', '2')
            ->whereHas('arsip', function ($query) use ($search) {
                if ($search) {
                    $query->where('nomor_surat', 'like', "%{$search}%")
                          ->orWhere('perihal', 'like', "%{$search}%")
                          ->orWhere('asal_surat', 'like', "%{$search}%");
                }
            })
            ->latest()
            ->paginate(10);

        return view('dataInformasi.arsipKeluar', [

            'Halaman' => 'Data & Informasi',
            'arsip' => $arsip
        ]);

    }

    public function arsipKeluar()
    {
        $arsip = Data::with(['arsip.rak'])
        ->where('data.data_id', '2')
        ->whereHas('arsip.rak', function ($query) {
        })
        ->latest()
        ->paginate(10);
        

        // dd($arsip);

        return view('dataInformasi.arsipKeluar', [

            'Halaman' => 'Data & Informasi',
            'arsip' => $arsip
        ]);
    }

    public function kategori(){
        $kategori = Ketegori::paginate(10);
        return view('dataInformasi.kategori', [
            'kategori' => $kategori,
            'Halaman' => 'Kategori Surat'
        ]);

    }

    public function updateKategori(Request $request, Ketegori $kategori)
    {
        // dd($request);
        $validatedData = $request->validate([
            'kategori_surat' => 'required|string|max:255',
        ]);

        $kategori->update($validatedData);

        Alert::success('Success Title', 'Update data berhasil!');
        return redirect('/master/kategori');
    }

    public function createKategori(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'kategori_surat' => 'required',
        ]);

        Ketegori::create($validatedData);
        Alert::success('Success Title', 'Tambah data berhasil !');
        return redirect('/master/kategori');
    }

    public function hapusKategori(Ketegori $kategori)
    {
        // dd($request);
        Ketegori::destroy($kategori->id);
        Alert::success('Success', 'data berhasil di hapus !');
        return redirect('/master/kategori');
    }

    public function rak(){

        $rak = Rak::paginate(10);

        return view('dataInformasi.rak', [
            'raks' => $rak,
            'halaman' => 'Daftar Rak'
        ]);
    }

    // public function show($id){
    //     $rak = Rak::find($id);
    //     return response()->json($rak);
    // }

    public function exportExcelSM()
    {
        $arsip = Data::with(['arsip.rak'])
        ->where('data.data_id', '1')
        ->whereHas('arsip.rak')
        ->latest()
        ->get();

        // dd($arsip);

        return Excel::download(new ArsipExport($arsip), 'arsip-surat-masuk.xlsx');
    }

    public function exportExcelSK()
    {
        $arsip = Data::with(['arsip.rak'])
        ->where('data.data_id', '2')
        ->whereHas('arsip.rak')
        ->latest()
        ->get();

        // dd($arsip);

        return Excel::download(new ArsipExport($arsip), 'arsip-surat-keluar.xlsx');
    }

    public function createRak(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'pemilik_rak' => 'required',
            'nama_rak' => 'required',
        ]);

        Rak::create($validatedData);
        Alert::success('Success Title', 'Tambah data berhasil !');
        return redirect('/master/daftar-rak');
    }

    public function hapusRak(Rak $rak)
    {
        // dd($request);
        Rak::destroy($rak->id);
        Alert::success('Success', 'Jenis Rak Berhasil di Hapus !');
        return redirect('/master/daftar-rak');
    }

    public function updateRak(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'nama_rak' => 'required|string|max:255',
            'pemilik_rak' => 'required|string|max:255',
        ]);

        // Update data ke database
        $rak = Rak::find($id);
        $rak->nama_rak = $request->input('nama_rak');
        $rak->pemilik_rak = $request->input('pemilik_rak');
        $rak->save();

        Alert::success('Success', 'Data Berhasil di Update !');
        return redirect('/master/daftar-rak');
    }
    


    public function viewTambah()
    {
        $kategori = Ketegori::all();
        $rak = Rak::all();
        $agenda = Data::where('data_id', '=', '1')->count();
        return view('dataInformasi.tambahdata', [
            'kategori' => $kategori,
            'rak' => $rak,
            'agenda' => $agenda
        ]);
    }

    public function viewTambahSK()
    {
        $kategori = Ketegori::all();
        $rak = Rak::all();
        $agenda = Data::where('data_id', '=', '2')->count();
        return view('dataInformasi.createKeluarAdmin', [
            'kategori' => $kategori,
            'rak' => $rak,
            'agenda' => $agenda
        ]);
    }

    public function viewDetail(Data $data)
    {
        $arsip = Arsip::where('surat_id', $data->id)->first();
        return view('dataInformasi.detailSurat', [
            'data' => $data,
            'arsip' => $arsip
            // 'divisi' => Divisi::all()
        ]);
    }

    public function viewDetailSK(Data $data)
    {
        $arsip = Arsip::where('surat_id', $data->id)->first();
        return view('dataInformasi.detailSuratKeluar', [
            'data' => $data,
            'arsip' => $arsip
            // 'divisi' => Divisi::all()
        ]);
    }

    public function viewEdit(Data $data)
    {

        return view('dataInformasi.editData', [
            'data' => $data,
            'kategori' => Ketegori::all()
            // 'divisi' => Divisi::all()
        ]);
    }

    public function createSK(Request $request)
    {
        // dd($request);
        $request->merge(['pass_id' => (string) 2]);

        $messages = [
            'required' => 'Form tidak boleh kosong',
            'max' => 'Tidak boleh lebih dari :max karakter',
            'file' => 'File harus berupa file yang valid',
            'mimes' => 'File harus berupa file dengan tipe: :values',
        ];

        $rules = [
           'kategori_id' => 'required',
            'data_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'sifat' => 'required|max:255',
            'tanggal' => 'required',
            'asal_surat' => 'required|max:255',
            'perihal' => 'required|max:255',
            'lampiran' => 'required|max:255',
            'nomor_agenda' => 'required|max:255',
            'status' => '',
            'disposisi' => 'required',
            'file' => 'required|file|max:2400|mimes:pdf',
            'pass_id' => 'required|string'
        ];

        $validatedData = $request->validate($rules, $messages);

        if ($request->file('file')) {
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $fileContent = file_get_contents($filePath);

            // Encrypt the file content using AES encryption
            $encryptedContent = Crypt::encrypt($fileContent);

            // Define a storage path and filename
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = 'data-informasi/' . $originalFileName . '.txt';

            Storage::put($fileName, $encryptedContent);

            // Save the path to the database
            $validatedData['file'] = $fileName;
        }

        Data::create($validatedData);
        Alert::success('Success', 'Tambah data berhasil !');
        return redirect('/surat-keluar');
    }

    public function createDataInformasi(Request $request)
    {
        $request->merge(['pass_id' => (string) 1]);
        // dd($request);
        $messages = [
            'required' => 'Form tidak boleh kosong',
            'max' => 'Tidak boleh lebih dari :max karakter',
            'file' => 'File harus berupa file yang valid',
            'mimes' => 'File harus berupa file dengan tipe: :values',
        ];

        $rules = [
            'kategori_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'sifat' => 'required|max:255',
            'tanggal' => 'required',
            'asal_surat' => 'required|max:255',
            'perihal' => 'required|max:255',
            'lampiran' => 'required|max:255',
            'nomor_agenda' => 'required|max:255',
            'status' => 'required',
            'tindakan' => 'required',
            'file' => 'nullable|file|mimes:pdf',
            'pass_id' => 'required',
            'data_id' => 'required'
        ];

        $validatedData = $request->validate($rules, $messages);

        if ($request->file('file')) {
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $fileContent = file_get_contents($filePath);


            $encryptedContent = Crypt::encrypt($fileContent);

            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = 'data-informasi/' . $originalFileName . '.txt';

            Storage::put($fileName, $encryptedContent);

            $validatedData['file'] = $fileName;
        }

        // dd($validatedData);

        Data::create($validatedData);
        Alert::success('Success', 'Tambah data berhasil !');
        return redirect('/data-masuk');
    }



    public function editDataInformasi(Data $data, Request $request)
    {

        $request->merge(['pass_id' => (string) 1]);
        // dd($request);
        $messages = [
            'required' => 'Form tidak boleh kosong',
            'max' => 'Tidak boleh lebih dari :max karakter',
            'file' => 'File harus berupa file yang valid',
            'mimes' => 'File harus berupa file dengan tipe: :values',
        ];

        $rules = [
            'kategori_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'sifat' => 'required|max:255',
            'tanggal' => 'required',
            'asal_surat' => 'required|max:255',
            'perihal' => 'required|max:255',
            'lampiran' => 'required|max:255',
            'nomor_agenda' => 'required|max:255',
            // 'status' => 'required',
            'file' => 'nullable|file|mimes:pdf',
            'pass_id' => 'required'
        ];
    
        $validatedData = $request->validate($rules, $messages);
    
        if ($request->file('file')) {
            if ($data->file) {
                Storage::delete($data->file);
            }
    
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $fileContent = file_get_contents($filePath);
    
            $encryptedContent = Crypt::encrypt($fileContent);
    
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = 'data-informasi/' . $originalFileName . '.txt';
    
            Storage::put($fileName, $encryptedContent);

            $validatedData['file'] = $fileName;
        }

        
    
        $data->update($validatedData);
        Alert::success('Success', 'Update data berhasil !');
        return redirect('/data-masuk');
        // ->with('success', 'Artikel Berhasil Di Update!')

    }

    public function viewEditSK(Data $data){
        return view('dataInformasi.editDataSK', [
            'data' => $data,
            'kategori' => Ketegori::all()
            // 'divisi' => Divisi::all()
        ]);
    }

    public function editSKAdmin(Data $data, Request $request)
    {

        $request->merge(['pass_id' => (string) 2]);
        // dd($request);
        $messages = [
            'required' => 'Form tidak boleh kosong',
            'max' => 'Tidak boleh lebih dari :max karakter',
            'file' => 'File harus berupa file yang valid',
            'mimes' => 'File harus berupa file dengan tipe: :values',
        ];

        $rules = [
           'kategori_id' => 'required',
            'data_id' => 'required',
            'nomor_surat' => 'required|max:255',
            'sifat' => 'required|max:255',
            'tanggal' => 'required',
            'asal_surat' => 'required|max:255',
            'perihal' => 'required|max:255',
            'lampiran' => 'required|max:255',
            'nomor_agenda' => 'required|max:255',
            'status' => '',
            'disposisi' => 'required',
            'file' => 'required|file|max:2400|mimes:pdf',
            'pass_id' => 'required|string'
        ];
    
        $validatedData = $request->validate($rules, $messages);
    
        if ($request->file('file')) {
            if ($data->file) {
                Storage::delete($data->file);
            }
    
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $fileContent = file_get_contents($filePath);
    
            $encryptedContent = Crypt::encrypt($fileContent);
    
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = 'data-informasi/' . $originalFileName . '.txt';
    
            Storage::put($fileName, $encryptedContent);

            $validatedData['file'] = $fileName;
        }

    }


    public function hapusDatainformasi(Data $data)
    {

        Data::destroy($data->id);
        Alert::success('Success', 'data berhasil di hapus !');
        return back();;
        // ->with('success', 'Data Berhasil di Hapus !')
    }
}

