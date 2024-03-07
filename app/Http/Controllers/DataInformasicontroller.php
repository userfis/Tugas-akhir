<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DataInformasicontroller extends Controller
{
    public function master(){

        return view('dataInformasi.master');
    }
    public function masuk(){

        return view('dataInformasi.masuk');
    }
    public function viewTambah(){

        $data = Divisi::all();
        return view('dataInformasi.tambahdata',[
            'data' => $data
        ]);
    }
}
