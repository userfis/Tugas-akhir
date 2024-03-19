<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class DatakeluarController extends Controller
{
    public function dataKeluar(){

        return view('dataKeluar',[
            'data' => Email::all()
        ]);
    }
}
