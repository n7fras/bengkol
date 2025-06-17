<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mechanic;
class MechanicController extends Controller
{
    //
    public function index(){
        $mechanic = Mechanic::orderBy('user_id', 'asc')->get();
        $judul='List Mechanic';
        return view('backend.v_Mechanic.index', [
            'mechanics' => $mechanic,
            'judul'=>$judul
        ]);
    }
        
    
}
