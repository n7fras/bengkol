<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function login(){
        return view('backend.Layout.login', ['title' => 'Login']);
    }


    // Menangani proses autentikasi login
    public function authLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Periksa apakah email ada di database
        if (!Auth::getProvider()->retrieveByCredentials(['email' => $credentials['email']])) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Coba login dengan kredensial
        if (Auth::attempt($credentials)) { 
            // Memeriksa apakah pengguna aktif
            if (Auth::user()->status == 0) {
                Auth::logout();
                return back()->with('error', 'Akun Anda tidak aktif. Silahkan hubungi SuperAdmin anda.');
            }

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        
        // Jika gagal login karena password salah
        return back()->with('error', 'Password salah.');
    }
   

    // Logout pengguna
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login_mobas');
    }
}
