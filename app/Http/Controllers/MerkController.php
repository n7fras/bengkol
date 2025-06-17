<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    public function index()
    {
        $merks = Merk::all();
        return view('backend.v_merk.index', compact('merks'));
    }

    public function create()
    {
         $nextId = \DB::table('merk')->max('id_merk') + 1;
        return view('backend.v_merk.create',compact('nextId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk_name' => 'required|string|max:255'
        ]);

        Merk::create([
            'merk_name' => $request->merk_name
        ]);

        return redirect()->route('merk.index')->with('success', 'Merk berhasil ditambahkan!');
    }
}
