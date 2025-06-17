<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
class CustomerController extends Controller
{
    //
    public function login()
    {
        return view('frontend.V_customer.login',[
            'judul'=>'Login Customer',
        ]);
    }
    public function logout()
{
    Auth::guard('customer')->logout(); // Logout dari guard 'customer'
    return redirect('/')->with('success', 'Berhasil logout');
}

    public function index()
    {
        $cust =Customer::orderBy('id','asc')->get();
        return view('backend.V_customer.index',[
            'judul'=>'Data Customer',
            'cust'=>$cust,
        ]);
    }
    public function log()
    {
        return view('backend.V_customer.log_activity',[
            'judul'=>'Customer Activity Log',
        ]);
    }

    public function redirect()
    {
       return Socialite::driver('google')->redirect();
    }

  public function handle_google_callback()
{
    try {
        $google_user = Socialite::driver('google')->stateless()->user();
    } catch (\Exception $e) {
        return redirect('/customer/login')->withErrors('Error: ' . $e->getMessage());
    }
    
    // Lanjut proses login
    $customer = Customer::where('google_id', $google_user->id)->first();
    if (!$customer) {
        $customer = Customer::create([
            'google_id' => $google_user->id,
            'name' => $google_user->name,
            'email' => $google_user->email,
            'foto' => $google_user->avatar,
        ]);
    }
      Auth::guard('customer')->login($customer, true);
    return redirect('/')->with('success', 'Login Berhasil');
}

public function authLoginManual(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Cek apakah email ada
    $customer = Customer::where('email', $credentials['email'])->first();
    if (!$customer) {
        return back()->with('error', 'Email tidak ditemukan.');
    }

    // Cek kecocokan password
    if (!Hash::check($credentials['password'], $customer->password)) {
        return back()->with('error', 'Password salah.');
    }

    // Login customer ke guard 'customer'
    Auth::guard('customer')->login($customer);

    // Redirect ke home atau dashboard customer
    return redirect('/')->with('success', 'Login berhasil.');
}

//     public function handle_google_callback()
// {
//     try {
//         $google_user = Socialite::driver('google')->user();
//         // proses user
//     } catch (\Exception $e) {
//         return redirect('/customer/login')->withErrors('Login gagal: ' . $e->getMessage());
//     }
// }

}
