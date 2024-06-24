<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin == '0') {
                // echo "superadmin"; die();
                return redirect()->intended('/home');
            }
            elseif (Auth::user()->is_admin == '1') {
                // echo "sekretaris"; die();
                return redirect()->intended('/home');
            }
            elseif (Auth::user()->is_admin == '2') {
                // echo "Ketua KPU"; die();
                return redirect()->intended('/home');
            }
            elseif (Auth::user()->is_admin == '3') {
                // echo "Staff data"; die();
                return redirect()->intended('/home');
            }
            elseif (Auth::user()->is_admin == '4') {
                // echo "staff hukum"; die();
                return redirect()->intended('/home');
            }
            elseif (Auth::user()->is_admin == '5') {
                // echo "staff keuangan"; die();
                return redirect()->intended('/home');
            }
            elseif (Auth::user()->is_admin == '6') {
                // echo "staff teknis"; die();
                return redirect()->intended('/home');
            }
            // return redirect()->intended('/home');
        }
        else{
            return redirect('/')->with('alert','Username atau Password, Salah !');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
