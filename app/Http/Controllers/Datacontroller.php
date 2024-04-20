<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class Datacontroller extends Controller
{
    public function dashboard(){

        $data = Data::whereNotIn('status', ['ditolak'])
            ->where(function ($query) {
                $search = request('search');
                $query->where('judul', 'like', "%" . $search . "%")
                    ->orWhere('nomor_surat', 'like', "%" . $search . "%");
            })
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('beranda',[
            'data' => $data
        ]);
    }
    
}
