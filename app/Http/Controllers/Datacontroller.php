<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Datacontroller extends Controller
{
    public function dashboard(){

        return view('beranda');
    }
    
}
