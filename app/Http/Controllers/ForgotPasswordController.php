<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;

class ForgotPasswordController extends Controller
{
    public function sendResetLink($id)
{

    $user = User::find($id);

    if (!$user) {
        return redirect()->back()->withErrors(['User not found']);
    }

    // Ambil token yang sudah ada untuk pengguna ini
    $tokenbaru = Password::getRepository()->exists($user, 'passwords');

    
    if ($tokenbaru) {
        Password::getRepository()->delete($tokenbaru);
    }

    // Buat token yang baru
    $token = Password::getRepository()->create($user);

    // Kirim email reset password
    Mail::to($user->email)->send(new ResetPasswordMail($token));

    Alert::success('Success', ' Link Reset Password Telah di Kirim !');
    return redirect()->back()->with('status', 'Password reset link sent!');
    }
    

    public function showResetForm($token)
    {
        return view('dataInformasi.reset-pw', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // Validasi input
        // dd($request);
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Proses reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Update password pengguna
                $user->password = bcrypt($password);
                $user->save();
        
                // Tambahkan ini untuk memeriksa apakah callback dijalankan
                // dd($user);
            }
        );

        // Mengembalikan respon berdasarkan status reset password
        if ($status == Password::PASSWORD_RESET) {
            // Jika password berhasil diubah, arahkan ke halaman reset password dengan pesan sukses
            return redirect()->route('reset-password.form', ['token' => $request->token])->with('status', 'Password telah diubah');
        } else {
            // Jika terjadi kesalahan, kembalikan ke halaman sebelumnya dengan pesan error
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
