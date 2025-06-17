<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BerandaController extends Controller
{
    //
    public function berandabackend()
    {
        return view('frontend.beranda.index',[
            'judul' => 'Halaman Beranda',

        ]);
        
    }
    public function index() 
    { 
        $produk= Product::where ('status',1)->orderby('updated_at','desc')->paginate(6); 
        return view('frontend.beranda.index', [ 
            'judul' => 'Halan Beranda', 
            'produk' => $produk, 
        ]); 
    } 
   
}
