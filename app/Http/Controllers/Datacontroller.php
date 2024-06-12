<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Data;
use App\Models\Arsip;
use Illuminate\Http\Request;

class Datacontroller extends Controller
{
    public function dashboard(){

        $data = Data::where('data_id', '=', '1')->count();

        $keluar = Data::where('data_id', '=', '1')->count();
        
        $dathar = Data::where('data_id', 1)
        ->whereDate('created_at', Carbon::today())
        ->count();

        $kelhar = Data::where('data_id', 2)
        ->whereDate('created_at', Carbon::today())
        ->count();

        $dishar = Data::where('status', '=', 'Disposisi')->orWhere('status', '=', 'Disposisi')
        ->whereDate('created_at', Carbon::today())
        ->count();

        // $kelhar = Data::where();
        $dis = Data::where('status', '=', 'Disposisi')
        ->orWhere('status', '=', 'Selesai Disposisi')
        ->count();

        $arhar = Arsip::whereDate('created_at', Carbon::today())->count();

        $arsip = Arsip::all()->count();

        return view('beranda',[
            'data' => $data,
            'keluar' => $keluar,
            'dis' => $dis, 
            'kelhar'=> $kelhar,
            'arsip' => $arsip,
            'dathar' => $dathar,
            'arhar' => $arhar,
            'dishar' => $dishar
        ]);
    }
    
}
